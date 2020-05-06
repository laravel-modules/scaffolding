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

<select2 name="user_id"
         label="@lang('accounts::users.singular')"
         select-text="@lang('accounts::users.select')"
         remote-url="{{ route('users.select') }}"
         :value=""
></select2>

