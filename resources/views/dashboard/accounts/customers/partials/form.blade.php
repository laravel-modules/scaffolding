@include('dashboard.errors')
{{ BsForm::text('name') }}
{{ BsForm::text('email') }}
{{ BsForm::text('phone') }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}

@isset($customer)
    <file-uploader :media="{{ $customer->getMediaResource('avatars') }}"
                   name="avatar"
                   :max="1"
                   collection="avatars"
                   :tokens="{{ json_encode(old('avatar', [])) }}"
                   label="{{ __('customers.attributes.avatar') }}"
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
        label="{{ __('customers.attributes.avatar') }}"
        notes="Supported types: jpeg, png,jpg,gif"
        accept="image/jpeg,image/png,image/jpg,image/gif"
    ></file-uploader>
@endisset
