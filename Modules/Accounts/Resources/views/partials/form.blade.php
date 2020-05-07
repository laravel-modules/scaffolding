{{ BsForm::text('name') }}
{{ BsForm::email('email') }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}
@isset($user)
    @can('updateType', $user)
        {{ BsForm::select('type')->options(trans('accounts::users.types')) }}
    @endcan
@else
    {{ BsForm::select('type')->options(trans('accounts::users.types')) }}
@endisset
