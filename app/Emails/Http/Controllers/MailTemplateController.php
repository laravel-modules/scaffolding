<?php

namespace App\Emails\Http\Controllers;

use App\Http\Requests\Dashboard\MailTemplateRequest;
use App\Models\MailTemplate;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class MailTemplateController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->authorizeResource(MailTemplate::class, 'mail_template');
    }

    /**
     * Display a listing of the mail templates.
     */
    public function index(): View
    {
        $mailTemplates = MailTemplate::filter()->latest()->paginate();

        return view('dashboard.mail-templates.index', compact('mailTemplates'));
    }

    /**
     * Show the form for creating a new mail template.
     */
    public function create(): View|RedirectResponse
    {
        $types = array_keys(MailTemplate::types());

        if (empty($types) || ! in_array(request('model_type'), $types)) {
            return redirect()->route('dashboard.mail-templates.index');
        }

        return view('dashboard.mail-templates.create');
    }

    /**
     * Store a newly created mail template in storage.
     */
    public function store(MailTemplateRequest $request): RedirectResponse
    {
        $types = array_keys(MailTemplate::types());

        if (empty($types) || ! in_array(request('model_type'), $types)) {
            return redirect()->route('dashboard.mail-templates.index');
        }

        $mailTemplate = MailTemplate::create($request->all());

        flash()->success(__('mail-templates.messages.created'));

        return redirect()->route('dashboard.mail-templates.show', $mailTemplate);
    }

    /**
     * Display the specified mail template.
     */
    public function show(MailTemplate $mailTemplate): View
    {
        return view('dashboard.mail-templates.show', compact('mailTemplate'));
    }

    /**
     * Show the form for editing the specified mail template.
     */
    public function edit(MailTemplate $mailTemplate): View
    {
        return view('dashboard.mail-templates.edit', compact('mailTemplate'));
    }

    /**
     * Update the specified mail template in storage.
     */
    public function update(
        MailTemplateRequest $request,
        MailTemplate $mailTemplate
    ): RedirectResponse {
        $mailTemplate->update($request->all());

        flash()->success(__('mail-templates.messages.updated'));

        return redirect()->route('dashboard.mail-templates.show', $mailTemplate);
    }

    /**
     * Remove the specified mail template from storage.
     */
    public function destroy(MailTemplate $mailTemplate): RedirectResponse
    {
        $mailTemplate->delete();

        flash()->success(__('mail-templates.messages.deleted'));

        return redirect()->route('dashboard.mail-templates.index');
    }

    /**
     * Display a listing of the trashed mail templates.
     */
    public function trashed(): View
    {
        $this->authorize('viewAnyTrash', MailTemplate::class);

        $mailTemplates = MailTemplate::onlyTrashed()->latest('deleted_at')->paginate();

        return view('dashboard.mail-templates.trashed', compact('mailTemplates'));
    }

    /**
     * Display the specified trashed mail template.
     */
    public function showTrashed(MailTemplate $mailTemplate): View
    {
        $this->authorize('viewTrash', $mailTemplate);

        return view('dashboard.mail-templates.show', compact('mailTemplate'));
    }

    /**
     * Restore the trashed mail template.
     */
    public function restore(MailTemplate $mailTemplate): RedirectResponse
    {
        $this->authorize('restore', $mailTemplate);

        $mailTemplate->restore();

        flash()->success(__('mail-templates.messages.restored'));

        return redirect()->route('dashboard.mail-templates.trashed');
    }

    /**
     * Force delete the specified mail template from storage.
     */
    public function forceDelete(MailTemplate $mailTemplate): RedirectResponse
    {
        $this->authorize('forceDelete', $mailTemplate);

        $mailTemplate->forceDelete();

        flash()->success(__('mail-templates.messages.deleted'));

        return redirect()->route('dashboard.mail-templates.trashed');
    }
}
