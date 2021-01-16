<?php

namespace App\Http\Controllers\Settings\Dashboard;

use App\Models\Setting;
use App\Support\SettingJson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laraeast\LaravelSettings\Facades\Settings;

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
            Settings::set($file)->addAllMediaFromTokens([], $file);
        }

        app(SettingJson::class)->update();

        flash(trans('settings.messages.updated'));

        return back();
    }
}
