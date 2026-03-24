<?php

Breadcrumbs::for('dashboard.mail-templates.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(__('mail-templates.plural'), route('dashboard.mail-templates.index'));
});

Breadcrumbs::for('dashboard.mail-templates.trashed', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.mail-templates.index');
    $breadcrumb->push(__('mail-templates.trashed'), route('dashboard.mail-templates.trashed'));
});

Breadcrumbs::for('dashboard.mail-templates.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.mail-templates.index');
    $breadcrumb->push(__('mail-templates.actions.create'), route('dashboard.mail-templates.create'));
});

Breadcrumbs::for('dashboard.mail-templates.show', function ($breadcrumb, $mailTemplate) {
    $breadcrumb->parent('dashboard.mail-templates.index');
    $breadcrumb->push($mailTemplate->name ?: '#'.$mailTemplate->id, route('dashboard.mail-templates.show', $mailTemplate));
});

Breadcrumbs::for('dashboard.mail-templates.edit', function ($breadcrumb, $mailTemplate) {
    $breadcrumb->parent('dashboard.mail-templates.show', $mailTemplate);
    $breadcrumb->push(__('mail-templates.actions.edit'), route('dashboard.mail-templates.edit', $mailTemplate));
});
