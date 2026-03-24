<?php

use App\Emails\Http\Controllers\MailJobController;
use App\Emails\Http\Controllers\MailTemplateController;
use App\Emails\Http\Controllers\SendBatchEmailsController;

Route::post('emails/batch', SendBatchEmailsController::class)->name('emails.batch');

Route::get('trashed/mail-templates', [MailTemplateController::class, 'trashed'])->name('mail-templates.trashed');
Route::get('trashed/mail-templates/{trashed_mail_template}', [MailTemplateController::class, 'showTrashed'])->name('mail-templates.trashed.show');
Route::post('mail-templates/{trashed_mail_template}/restore', [MailTemplateController::class, 'restore'])->name('mail-templates.restore');
Route::delete('mail-templates/{trashed_mail_template}/forceDelete', [MailTemplateController::class, 'forceDelete'])->name('mail-templates.forceDelete');
Route::resource('mail-templates', MailTemplateController::class);
Route::resource('emails', MailJobController::class)->only(['index', 'show']);
