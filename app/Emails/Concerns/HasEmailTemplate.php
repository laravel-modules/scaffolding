<?php

namespace App\Emails\Concerns;

use Illuminate\Support\Facades\Mail;
use Laraeast\LaravelSettings\Facades\Settings;

trait HasEmailTemplate
{
    /**
     * Custom replacements (can be overridden in model)
     */
    public function customEmailReplacements(): array
    {
        return [];
    }

    /**
     * Generate default replacements from fillable fields
     */
    public function defaultEmailReplacements(): array
    {
        $replacements = [];

        $model = str(class_basename($this))->snake()->upper()->toString();

        foreach ($this->getFillable() as $field) {
            $value = is_object($this->{$field}) && enum_exists(get_class($this->{$field}))
                ? $this->{$field}->value : $this->{$field};

            $key = '%'.$model.'_'.strtoupper($field).'%';

            $replacements[$key] = $value;
        }

        return $replacements;
    }

    /**
     * Get default email content from settings.
     */
    public function defaultEmailContent(): string
    {
        $model = str(class_basename($this))->lower()->snake()->plural()->toString();

        return Settings::get("{$model}_emails_welcome_content", '');
    }

    /**
     * Get default email subject.
     */
    public function defaultEmailSubject(): string
    {
        $model = str(class_basename($this))->lower()->snake()->plural()->toString();

        return Settings::get("{$model}_emails_welcome_subject", '');
    }

    /**
     * Merge default + custom replacements
     */
    public function emailReplacements(): array
    {
        return array_merge(
            $this->defaultEmailReplacements(),
            $this->customEmailReplacements()
        );
    }

    /**
     * Apply replacements to template
     */
    public function applyEmailReplacements(string $content): string
    {
        return str_replace(
            array_keys($this->emailReplacements()),
            array_values($this->emailReplacements()),
            $content
        );
    }

    /**
     * Resolve email column name (default: email).
     */
    public function getEmailColumn(): string
    {
        return defined(static::class.'::EMAIL_COLUMN') ? static::EMAIL_COLUMN : 'email';
    }

    /**
     * Get email address from model.
     */
    public function getEmailAddress(): ?string
    {
        return $this->{$this->getEmailColumn()};
    }

    /**
     * Send email.
     */
    public function sendEmail(?string $subject = null, ?string $content = null): void
    {
        $subject = $subject ?: $this->defaultEmailSubject();

        $subject = $this->applyEmailReplacements($subject);

        $content = $content ?: $this->defaultEmailContent();

        $content = $this->applyEmailReplacements($content);

        Mail::html($content, function ($message) use ($subject) {
            $message->to($this->getEmailAddress())
                ->subject($subject);
        });
    }
}
