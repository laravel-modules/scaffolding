@include('dashboard::errors')
{{ BsForm::text('name') }}
{{ BsForm::text('email') }}
{{ BsForm::text('phone') }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}

@isset($customer)
    {{ BsForm::image('avatar')->files($customer->getMediaResource('avatars')) }}
@else
    {{ BsForm::image('avatar') }}
@endisset
