<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Laraeast\LaravelSettings\Facades\Settings;
use LaravelModules\ModuleGenerator\Generator;

class SettingController extends Controller
{
    /**
     * The list of the files keys.
     *
     * @var array
     */
    protected $files = [
        'logo',
        'favicon',
    ];

    /**
     * Display the settings page.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (! $tab = request('tab')) {
            return redirect()->route('dashboard.settings.index', ['tab' => 'main']);
        }

        $this->authorize('manage', Setting::class);

        if (! view()->exists($view = "dashboard.settings.tabs.$tab")) {
            abort(404);
        }

        return view($view);
    }

    /**
     * Update the website global settings.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        foreach (
            $request->except(
                array_merge(['_token', '_method', 'media'], $this->files)
            )
            as $key => $value
        ) {
            Settings::set($key, $value);
        }

        foreach ($this->files as $file) {
            Settings::set($file)->addAllMediaFromTokens($request->input($file), $file);
        }

        flash()->success(trans('settings.messages.updated'));

        return back();
    }

    /**
     * Update the environment credentials.
     */
    public function env(Request $request): RedirectResponse
    {
        $env = app(Generator::class)->environment(envFile: '.env');

        foreach ($request->except(['_token', '_method']) as $key => $value) {
            $env->set($key, $value);
        }

        $env->publish();

        if (app()->configurationIsCached()) {
            Artisan::call('config:cache');
        }

        Artisan::call('queue:restart');

        flash()->success(trans('settings.messages.updated'));

        return back();
    }

    /**
     * Download a fresh database and storage backup.
     *
     * @throws \Illuminate\Validation\ValidationException
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadBackup()
    {
        Artisan::call('backup:run');

        $lastBackup = collect(Storage::disk('local')->files('laravel-backup'))->last();

        if (! $lastBackup) {
            throw ValidationException::withMessages([
                'backup' => trans('backup.not-found'),
            ]);
        }

        return response()
            ->download(
                Storage::disk('local')->path($lastBackup)
            )
            ->deleteFileAfterSend();
    }
}
