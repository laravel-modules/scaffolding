@include('dashboard::errors')
{{ BsForm::text('name') }}
{{ BsForm::email('email')->required() }}
{{ BsForm::text('phone')->required() }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}
{{--{{ BsForm::file('avatar')}}--}}

<file-uploader :files="{{
    json_encode(
        \Modules\Media\Transformers\MediaResource::collection(
            \App\Media::latest()->get())->jsonSerialize()
        )
         }}"></file-uploader>
