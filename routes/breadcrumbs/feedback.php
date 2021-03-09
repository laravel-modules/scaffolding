<?php

Breadcrumbs::for('dashboard.feedback.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('feedback.plural'), route('dashboard.feedback.index'));
});

Breadcrumbs::for('dashboard.feedback.trashed', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.feedback.index');
    $breadcrumb->push(trans('feedback.trashed'), route('dashboard.feedback.trashed'));
});

Breadcrumbs::for('dashboard.feedback.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.feedback.index');
    $breadcrumb->push(trans('feedback.actions.create'), route('dashboard.feedback.create'));
});

Breadcrumbs::for('dashboard.feedback.show', function ($breadcrumb, $feedback) {
    $breadcrumb->parent('dashboard.feedback.index');
    $breadcrumb->push($feedback->name, route('dashboard.feedback.show', $feedback));
});

Breadcrumbs::for('dashboard.feedback.edit', function ($breadcrumb, $feedback) {
    $breadcrumb->parent('dashboard.feedback.show', $feedback);
    $breadcrumb->push(trans('feedback.actions.edit'), route('dashboard.feedback.edit', $feedback));
});
