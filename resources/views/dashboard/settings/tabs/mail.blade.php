<x-layout :title="trans('settings.tabs.mail')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')
        <div dir="ltr" style="text-align: left;">
            {{ BsForm::select('mail_driver')
                ->options([
                    'smtp' => 'smtp',
                    'sendmail' => 'sendmail',
                    'mailgun' => 'mailgun',
                    'ses' => 'ses',
                    'postmark' => 'postmark',
                    'log' => 'log',
                    'array' => 'array',
                ])
                ->value(Settings::get('mail_driver', env('MAIL_DRIVER'))) }}
            {{ BsForm::text('mail_host')->value(Settings::get('mail_host', env('MAIL_HOST'))) }}
            {{ BsForm::text('mail_port')->value(Settings::get('mail_port', env('MAIL_PORT'))) }}
            {{ BsForm::text('mail_username')->value(Settings::get('mail_username', env('MAIL_USERNAME'))) }}
            {{ BsForm::text('mail_password')->value(Settings::get('mail_password', env('MAIL_PASSWORD'))) }}
            {{ BsForm::text('mail_encryption')->value(Settings::get('mail_encryption', 'tls')) }}
            {{ BsForm::text('mail_from_address')->value(Settings::get('mail_from_address', env('MAIL_FROM_ADDRESS'))) }}
            {{ BsForm::text('mail_from_name')->value(Settings::get('mail_from_name', env('MAIL_FROM_NAME'))) }}
        </div>

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>