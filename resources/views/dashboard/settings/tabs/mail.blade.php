<x-layout :title="trans('settings.tabs.mail')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.env')) }}

    @include('dashboard.settings.partials.env-note')

    @component('dashboard::components.box')
        <div dir="ltr" style="text-align: left;">
            {{ BsForm::select('MAIL_MAILER')
                ->label('Mail Mailer')
                ->options([
                    'smtp' => 'SMTP',
                    'log' => 'Log',
                    'array' => 'Array',
                ])
                ->value(config('mail.default')) }}
            {{ BsForm::text('MAIL_HOST')->label('Mail Host')->value(config('mail.mailers.smtp.host')) }}
            {{ BsForm::number('MAIL_PORT')->label('Mail Port')->required()->value(config('mail.mailers.smtp.port')) }}
            {{ BsForm::text('MAIL_USERNAME')->label('Mail Username')->value(config('mail.mailers.smtp.username')) }}
            {{ BsForm::text('MAIL_PASSWORD')->label('Mail Password')->value(config('mail.mailers.smtp.password')) }}
            {{ BsForm::text('MAIL_FROM_ADDRESS')->label('Mail From Address')->value(config('mail.from.address')) }}
            {{ BsForm::text('MAIL_FROM_NAME')->label('Mail From Name')->value(old('MAIL_FROM_NAME', config('mail.from.name'))) }}
        </div>

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
