<?php

namespace App\Emails\Contracts;

interface HasEmailTemplateContract
{
    /**
     * Custom replacements defined by the model.
     */
    public function customEmailReplacements(): array;

    /**
     * Default replacements generated from fillable fields.
     */
    public function defaultEmailReplacements(): array;

    /**
     * Get all replacements.
     */
    public function emailReplacements(): array;

    /**
     * Apply replacements to content.
     */
    public function applyEmailReplacements(string $content): string;

    /**
     * Get email column name.
     */
    public function getEmailColumn(): string;

    /**
     * Get email address.
     */
    public function getEmailAddress(): ?string;

    /**
     * Send email using template content.
     */
    public function sendEmail(string $subject, string $content): void;

    /**
     * Retrieve the recipient profile link.
     */
    public function getRecipientProfileLink(): string;

    /**
     * Retrieve the recipient profile link.
     */
    public function getRecipientName(): string;
}
