<?php

Breadcrumbs::for('dashboard.emails.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(__('emails.jobs'), route('dashboard.emails.index'));
});

Breadcrumbs::for('dashboard.emails.show', function ($breadcrumb, $email) {
    $breadcrumb->parent('dashboard.emails.index');
    $breadcrumb->push($email->email ?: '#'.$email->id, route('dashboard.emails.show', $email));
});
