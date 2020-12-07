<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ Locales::getDir() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('dashboard.auth.forget.title') | {{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if(Locales::getDir() == 'rtl')
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte3-auth.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte3-auth.css')) }}">
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
            <p class="login-box-msg">@lang('dashboard.auth.forget.info')</p>

            <form action="{{ route('password.email') }}" method="post">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="input-group mb-4">
                    <input type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email"
                           value="{{ old('email') }}"
                           autofocus
                           placeholder="@lang('dashboard.auth.forget.email')">
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
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">
                            @lang('dashboard.auth.forget.submit')
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
<script src="{{ asset(mix('/js/adminlte3-auth.js')) }}"></script>
</body>
</html>
