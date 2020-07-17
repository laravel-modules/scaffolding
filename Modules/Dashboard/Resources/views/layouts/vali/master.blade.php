<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">
<head>
    <title>{{ isset($title) ? $title .' | '. config('app.name', 'Laravel') : config('app.name', 'Laravel')}}</title>
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
            <!-- Language Menu-->
            <li class="dropdown">
                <a class="app-nav__item text-decoration-none"
                   href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                    <img src="{{ Locales::getFlag() }}" alt="">
                    <span class="d-none d-md-inline">
                        {{ Locales::getName() }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    @foreach(Locales::get() as $locale)
                        <a href="{{ route('dashboard.locale', $locale->code) }}"
                           class="dropdown-item {{ app()->getLocale() == $locale->code ? 'active' : '' }}">
                            <img src="{{ $locale->flag }}" alt="">
                            {{ $locale->name }}
                        </a>
                    @endforeach
                </div>
            </li>
            <!--Notification Menu-->
            <li class="dropdown">
                <a class="app-nav__item"
                   href="#" data-toggle="dropdown"
                   aria-label="Show notifications">
                    <i class="fas fa-bell fa-lg"></i>
                </a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">You have 4 new notifications.</li>
                    <div class="app-notification__content">
                        <li>
                            <a class="app-notification__item" href="javascript:;">
                                <span class="app-notification__icon">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                    </span>
                                </span>
                                <div>
                                    <p class="app-notification__message">Lisa sent you a mail</p>
                                    <p class="app-notification__meta">2 min ago</p>
                                </div>
                            </a>
                        </li>
                        <li><a class="app-notification__item" href="javascript:;"><span
                                        class="app-notification__icon"><span class="fa-stack fa-lg"><i
                                                class="fa fa-circle fa-stack-2x text-danger"></i><i
                                                class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                                <div>
                                    <p class="app-notification__message">Mail server not working</p>
                                    <p class="app-notification__meta">5 min ago</p>
                                </div>
                            </a></li>
                        <li><a class="app-notification__item" href="javascript:;"><span
                                        class="app-notification__icon"><span class="fa-stack fa-lg"><i
                                                class="fa fa-circle fa-stack-2x text-success"></i><i
                                                class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                                <div>
                                    <p class="app-notification__message">Transaction complete</p>
                                    <p class="app-notification__meta">2 days ago</p>
                                </div>
                            </a></li>
                        <div class="app-notification__content">
                            <li><a class="app-notification__item" href="javascript:;"><span
                                            class="app-notification__icon"><span class="fa-stack fa-lg"><i
                                                    class="fa fa-circle fa-stack-2x text-primary"></i><i
                                                    class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">Lisa sent you a mail</p>
                                        <p class="app-notification__meta">2 min ago</p>
                                    </div>
                                </a></li>
                            <li><a class="app-notification__item" href="javascript:;"><span
                                            class="app-notification__icon"><span class="fa-stack fa-lg"><i
                                                    class="fa fa-circle fa-stack-2x text-danger"></i><i
                                                    class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">Mail server not working</p>
                                        <p class="app-notification__meta">5 min ago</p>
                                    </div>
                                </a></li>
                            <li><a class="app-notification__item" href="javascript:;"><span
                                            class="app-notification__icon"><span class="fa-stack fa-lg"><i
                                                    class="fa fa-circle fa-stack-2x text-success"></i><i
                                                    class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">Transaction complete</p>
                                        <p class="app-notification__meta">2 days ago</p>
                                    </div>
                                </a></li>
                        </div>
                    </div>
                    <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
                </ul>
            </li>
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
                 src="{{ auth()->user()->getAvatar() }}"
                 alt="{{ auth()->user()->name }}">
            <div>
                <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
                <p class="app-sidebar__user-designation">{{ auth()->user()->present()->type }}</p>
            </div>
        </div>
        <ul class="app-menu">
            @include('dashboard::sidebar')
        </ul>
    </aside>
    <main class="app-content">
        @yield('content')
    </main>
</div>
<!-- Scripts -->
<script src="{{ asset(mix('/js/vali.js')) }}"></script>

@stack('scripts')
</body>
</html>