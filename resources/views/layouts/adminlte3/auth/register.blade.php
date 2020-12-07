<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ Locales::getDir() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('dashboard.auth.register.title') | {{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if(Locales::getDir() == 'rtl')
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte3-auth.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte3-auth.css')) }}">
    @endif
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/') }}"><b>{{ config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group mb-4">
                    <input type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name"
                           value="{{ old('name') }}"
                           autofocus
                           placeholder="@lang('dashboard.auth.register.name')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-4">
                    <input type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="@lang('dashboard.auth.register.email')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-4">
                    <input type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           required
                           name="password"
                           autocomplete="new-password"
                           placeholder="@lang('dashboard.auth.register.password')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <input type="password"
                           class="form-control"
                           required
                           name="password_confirmation"
                           autocomplete="new-password"
                           placeholder="@lang('dashboard.auth.register.password_confirmation')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <p class="mb-1 mt-2">
                            <a href="{{ route('login') }}">@lang('dashboard.auth.register.login')</a>
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            @lang('dashboard.auth.register.submit')
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
                <small class="mb-1 mt-2 text-right float-right">
                    @foreach(Locales::get() as $locale)
                        <a href="{{ route('login', ['language' => $locale->code]) }}"
                           class="mx-2 {{ app()->getLocale() == $locale->code ? 'active' : '' }}">
                            <img src="{{ $locale->flag }}" alt="">
                            {{ $locale->name }}
                        </a>
                    @endforeach
                </small>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<script src="{{ asset(mix('/js/adminlte-auth.js')) }}"></script>
</body>
</html>
