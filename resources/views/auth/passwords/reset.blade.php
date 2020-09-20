<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ Locales::getDir() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('dashboard.auth.reset.title') | {{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if(Locales::getDir() == 'rtl')
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte-auth.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte-auth.css')) }}">
    @endif
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b>{{ config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <form action="{{ route('password.update') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group mb-4">
                    <input type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email"
                           value="{{ $email ?? old('email') }}"
                           placeholder="@lang('dashboard.auth.reset.email')">
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
                           placeholder="@lang('dashboard.auth.reset.password')">
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
                           placeholder="@lang('dashboard.auth.reset.password_confirmation')">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">
                            @lang('dashboard.auth.reset.submit')
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<script src="{{ asset(mix('/js/adminlte-auth.js')) }}"></script>
</body>
</html>
