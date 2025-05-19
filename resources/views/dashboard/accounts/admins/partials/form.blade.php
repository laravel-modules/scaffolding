@include('dashboard.errors')
{{ BsForm::text('name') }}
{{ BsForm::email('email')->required() }}
{{ BsForm::text('phone')->required() }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}
@isset($admin)
    <file-uploader :media="{{ $admin->getMediaResource('avatars') }}"
                   name="avatar"
                   :max="1"
                   collection="avatars"
                   :tokens="{{ json_encode(old('avatar', [])) }}"
                   label="{{ __('admins.attributes.avatar') }}"
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
                   label="{{ __('admins.attributes.avatar') }}"
                   notes="Supported types: jpeg, png,jpg,gif"
                   accept="image/jpeg,image/png,image/jpg,image/gif"
    ></file-uploader>
@endisset
