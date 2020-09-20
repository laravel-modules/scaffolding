<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}" xmlns:livewire="http://www.w3.org/1999/html">
<head>
    <title>{{ $title ? $title .' | '. config('app.name', 'Laravel') : config('app.name', 'Laravel')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Vali -->
    @if(Locales::getDir() == 'rtl')
        <link rel="stylesheet" href="{{ asset(mix('/css/vali.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ asset(mix('/css/vali.css')) }}">
    @endif

    @stack('styles')
    @livewireStyles
</head>
<body class="app sidebar-mini">
<div id="app">
    <!-- Navbar-->
    <header class="app-header">
        <a class="app-header__logo" href="{{ url('/') }}" target="_blank">
            {{ config('app.name') }}
        </a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!-- User Menu-->
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                    <i class="fa fa-user fa-lg"></i>
                </a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li>
                        <a class="dropdown-item" href="#"
                           onclick="event.preventDefault();document.getElementById('logoutForm').submit()">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            @lang('dashboard.auth.logout')
                        </a>
                        <form style="display: none;" action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar"
                 src="{{ auth()->user()->getFirstMediaUrl('avatars') }}"
                 alt="{{ auth()->user()->name }}">
            <div>
                <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
                <p class="app-sidebar__user-designation">{{ auth()->user()->email }}</p>
            </div>
        </div>
        <ul class="app-menu">
            @include('layouts.sidebar')
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>{{ $title }}</h1>
            </div>
            @isset($breadcrumbs)
                {{ Breadcrumbs::render(...$breadcrumbs) }}
            @endisset
        </div>
        @include('flash::message')
        {{ $slot }}
    </main>
</div>
@livewireScripts
<!-- Scripts -->
<script src="{{ asset(mix('/js/vali.js')) }}"></script>

@stack('scripts')
</body>
</html>
