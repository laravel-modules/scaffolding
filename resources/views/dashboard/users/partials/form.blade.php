{{ BsForm::text('name') }}
{{ BsForm::email('email') }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}
@can('updateType', $user)
    {{ BsForm::select('type')->options(trans('users.types')) }}
@endcan
