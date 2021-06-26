<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ $title ? $title .' | '. app_name() : app_name() }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="PUSHER_APP_KEY" content="{{ config('broadcasting.connections.pusher.key') }}">
    <meta name="PUSHER_APP_CLUSTER" content="{{ config('broadcasting.connections.pusher.options.cluster') }}">
    <meta name="PUSHER_APP_HOST" content="{{ config('broadcasting.connections.pusher.options.host') }}">
    <meta name="PUSHER_APP_PORT" content="{{ config('broadcasting.connections.pusher.options.port') }}">

    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon" />

    <!-- Admin Lte -->
    @if(Locales::getDir() == 'rtl')
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte3.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte3.css')) }}">
    @endif

    @stack('styles')

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('dashboard.home') }}" class="nav-link">@lang('dashboard.home')</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            @impersonating
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center"
                   href="{{ route('impersonate.leave') }}" aria-expanded="true">
                    <span class="d-none d-md-inline">
                       @lang('users.impersonate.leave')
                    </span>
                </a>
            </li>
            @endImpersonating
            <!-- Language Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                    <img src="{{ Locales::getFlag() }}" alt="{{ Locales::getName() }}">
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    @foreach(Locales::get() as $locale)
                        <a href="{{ route('dashboard.locale', $locale->code) }}"
                           class="dropdown-item {{ app()->getLocale() == $locale->code ? 'active' : '' }}">
                            <img src="{{ $locale->flag }}" alt="{{ $locale->name }}" class="mr-2">
                            {{ $locale->name }}
                        </a>
                    @endforeach
                </div>
            </li>
            <!-- Messages Dropdown Menu -->
            <adminte3-notification-dropdown></adminte3-notification-dropdown>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ auth()->user()->getAvatar() }}"
                         class="user-image img-circle elevation-2"
                         alt="{{ auth()->user()->name }}">
                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ auth()->user()->getAvatar() }}"
                             class="img-circle elevation-2"
                             alt="{{ auth()->user()->name }}">

                        <p>
                            {{ auth()->user()->name }} - {{ auth()->user()->present()->type }}
                            <small>@lang('users.since', ['date' => auth()->user()->created_at->diffForHumans()])</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ auth()->user()->dashboardProfile() }}" class="btn btn-default btn-flat">@lang('users.profile')</a>
                        <a href="#"
                           onclick="event.preventDefault();document.getElementById('logoutForm').submit()"
                           class="btn btn-default btn-flat float-right">@lang('dashboard.auth.logout')</a>
                        <form class="d-none" action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="brand-link">
            <img src="{{ app_logo() }}" alt="{{ app_name() }} Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ app_name() }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ auth()->user()->getAvatar() }}"
                         class="img-circle elevation-2"
                         alt="{{ auth()->user()->name }}">
                </div>
                <div class="info">
                    <a href="{{ auth()->user()->dashboardProfile() }}" class="d-block">
                        {{ auth()->user()->name }}
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @include('layouts.sidebar')
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex float-sm-right">
                            @isset($breadcrumbs)
                                {{ Breadcrumbs::render(...$breadcrumbs) }}
                            @endisset
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('flash::message')
                        {{ $slot }}
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
        <!-- Default to the left -->
        <strong>{{ app_copyright() }}</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Scripts -->
<script src="{{ asset(mix('/js/adminlte3.js')) }}"></script>

@stack('scripts')
</body>
</html>
