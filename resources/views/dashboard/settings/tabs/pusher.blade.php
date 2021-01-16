<x-layout :title="trans('settings.tabs.pusher')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')
        <div dir="ltr" style="text-align: left;">
            {{ BsForm::select('broadcast_driver')
                ->options([
                    'pusher' => 'pusher',
                    'redis' => 'redis',
                    'log' => 'log',
                    'null' => 'null',
                ])
                ->value(Settings::get('broadcast_driver', env('BROADCAST_DRIVER'))) }}
            {{ BsForm::text('pusher_app_id')->value(Settings::get('pusher_app_id', env('PUSHER_APP_ID'))) }}
            {{ BsForm::text('pusher_app_key')->value(Settings::get('pusher_app_key', env('PUSHER_APP_KEY'))) }}
            {{ BsForm::text('pusher_app_secret')->value(Settings::get('pusher_app_secret', env('PUSHER_APP_SECRET'))) }}
            {{ BsForm::text('pusher_app_cluster')->value(Settings::get('pusher_app_cluster', env('PUSHER_APP_CLUSTER'))) }}
            {{ BsForm::text('pusher_app_host')->value(Settings::get('pusher_app_host', env('PUSHER_APP_HOST'))) }}
            {{ BsForm::text('pusher_app_port')->value(Settings::get('pusher_app_port', env('PUSHER_APP_PORT'))) }}
            <div class="form-check my-3">
                <input type="hidden" name="pusher_app_encrypted" value="0">
                <input class="form-check-input" type="checkbox"
                       name="pusher_app_encrypted"
                       value="1"
                       {{ Settings::get('pusher_app_port', env('PUSHER_APP_ENCRYPTED')) ? 'checked' : '' }}
                       id="pusher_app_encrypted">
                <label class="form-check-label mx-4" for="pusher_app_encrypted">
                    @lang('settings.attributes.pusher_app_encrypted')
                </label>
            </div>
            {{ BsForm::select('pusher_app_scheme')
                ->options([
                    'https' => 'https',
                    'http' => 'http',
                ])
                ->value(Settings::get('pusher_app_scheme', env('PUSHER_APP_SCHEME'))) }}
        </div>

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>