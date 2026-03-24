<?php

namespace App\Policies;

use App\Models\MailTemplate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraeast\LaravelSettings\Facades\Settings;

class MailTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any mail templates.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.mail-templates');
    }

    /**
     * Determine whether the user can view the mail template.
     */
    public function view(User $user, MailTemplate $mailTemplate): bool
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.mail-templates');
    }

    /**
     * Determine whether the user can create mail templates.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.mail-templates');
    }

    /**
     * Determine whether the user can update the mail template.
     */
    public function update(User $user, MailTemplate $mailTemplate): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.mail-templates'))
            && ! $this->trashed($mailTemplate);
    }

    /**
     * Determine whether the user can delete the mail template.
     */
    public function delete(User $user, MailTemplate $mailTemplate): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.mail-templates'))
            && ! $this->trashed($mailTemplate);
    }

    /**
     * Determine whether the user can view trashed mail templates.
     */
    public function viewAnyTrash(User $user): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.mail-templates'))
            && $this->hasSoftDeletes();
    }

    /**
     * Determine whether the user can view the trashed mail template.
     */
    public function viewTrash(User $user, MailTemplate $mailTemplate): bool
    {
        return $this->view($user, $mailTemplate) && $mailTemplate->trashed();
    }

    /**
     * Determine whether the user can restore the mailTemplate.
     */
    public function restore(User $user, MailTemplate $mailTemplate): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.mail-templates'))
            && $this->trashed($mailTemplate);
    }

    /**
     * Determine whether the user can permanently delete the mailTemplate.
     */
    public function forceDelete(User $user, MailTemplate $mailTemplate): bool
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.mail-templates'))
            && $this->trashed($mailTemplate)
            && Settings::get('delete_forever');
    }

    /**
     * Determine wither the given mailTemplate is trashed.
     */
    public function trashed(MailTemplate $mailTemplate): bool
    {
        return $this->hasSoftDeletes() && method_exists($mailTemplate, 'trashed') && $mailTemplate->trashed();
    }

    /**
     * Determine wither the mail template use soft deleting trait.
     */
    public function hasSoftDeletes(): bool
    {
        return in_array(
            SoftDeletes::class,
            array_keys((new \ReflectionClass(MailTemplate::class))->getTraits())
        );
    }
}
