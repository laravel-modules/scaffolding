<?php

Breadcrumbs::for('dashboard.settings.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $name = trans('settings.tabs.'. request('tab', 'main'));
    $breadcrumb->push($name, route('dashboard.settings.index'));
});
