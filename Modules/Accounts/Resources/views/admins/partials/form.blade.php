@include('dashboard::errors')
{{ BsForm::text('name') }}
{{ BsForm::email('email')->required() }}
{{ BsForm::text('phone')->required() }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}
@isset($admin)
    {{ BsForm::image('avatar')->files($admin->getMediaResource('avatars')) }}
@else
    {{ BsForm::image('avatar') }}
@endisset
