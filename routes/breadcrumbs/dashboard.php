<?php

Breadcrumbs::for('dashboard.home', function ($breadcrumb) {
    $breadcrumb->push(trans('dashboard.home'), route('dashboard.home'));
});
