@include('dashboard.errors')
{{ BsForm::text('name') }}
{{ BsForm::text('email') }}
{{ BsForm::text('phone') }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}

@if(auth()->user()->isAdmin())
    <fieldset>
        <legend>@lang('permissions.plural')</legend>
        @foreach(config('permission.supported') as $permission)
            {{ BsForm::checkbox('permissions[]')
                    ->value($permission)
                    ->label(trans(str_replace('manage.', '', $permission.'.permission')))
                    ->checked(isset($supervisor) && $supervisor->hasPermissionTo($permission)) }}
        @endforeach
    </fieldset>
@endif

@isset($supervisor)
    <file-uploader :media="{{ $supervisor->getMediaResource('avatars') }}"
                   name="avatar"
                   :max="1"
                   collection="avatars"
                   :tokens="{{ json_encode(old('avatar', [])) }}"
                   label="{{ __('supervisors.attributes.avatar') }}"
                   notes="Supported types: jpeg, png,jpg,gif"
                   accept="image/jpeg,image/png,image/jpg,image/gif"
    ></file-uploader>
@else
    <file-uploader
        :media="[]"
        name="avatar"
        :max="1"
        collection="avatars"
        :tokens="{{ json_encode(old('avatar', [])) }}"
        label="{{ __('supervisors.attributes.avatar') }}"
        notes="Supported types: jpeg, png,jpg,gif"
        accept="image/jpeg,image/png,image/jpg,image/gif"
    ></file-uploader>
@endisset
