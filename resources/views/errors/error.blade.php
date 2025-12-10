<html style="height:100%" data-lt-installed="true">
<head>
    <style>body {
            transition: opacity ease-in 0.2s;
        }

        body[unresolved] {
            opacity: 0;
            display: block;
            overflow: hidden;
            position: relative;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __("errors.{$status}.title") }}</title>
    <style>@media (prefers-color-scheme: dark) {
            body {
                background-color: #000 !important
            }
        }</style>
</head>
<body style="color: #444; margin:0;font: normal 14px/20px Arial, Helvetica, sans-serif; height:100%; background-color: #fff;">
<div style="height:auto; min-height:100%;">
    <div style="text-align: center; width:800px; margin-left: -400px; position:absolute; top: 30%; left:50%;">
        <h1 style="margin:0; font-size:150px; line-height:150px; font-weight:bold;">{{ $status }}</h1>
        <h2 style="margin-top:20px;font-size: 30px;">{{ __("errors.{$status}.title") }}</h2>
        <p>{{ __("errors.{$status}.body") }}</p>
        @if($logout ?? false)
            <form action="{{ route('logout') }}" method="POST" style="display: none">
                @csrf
                <button class="btn btn-link" id="submit" type="submit">{{ __('errors.logout') }}</button>
            </form>
            <label for="submit" style="cursor: pointer;">{{ __('errors.logout') }}</label>
        @endif

        @if($home ?? false)
            <label for="submit" style="cursor: pointer;margin-left: 5px">{{ __('errors.home') }}</label>
        @endif
    </div>
</div>
</body>
</html>
