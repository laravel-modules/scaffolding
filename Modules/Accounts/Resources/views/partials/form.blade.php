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

<select2 name="user_id[]"
         :multiple="true"
         label="@lang('accounts::users.singular')"
         placeholder="@lang('accounts::users.select')"
         remote-url="{{ route('users.select',  ['type' => 'user']) }}"
         :value="{{ json_encode(old('user_id', [1,4])) }}"
></select2>

