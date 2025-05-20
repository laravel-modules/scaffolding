<x-layout :title="trans('settings.tabs.main')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')

        @bsMultilangualFormTabs

        {{ BsForm::text('name')->value(Settings::locale($locale->code)->get('name')) }}

        {{ BsForm::text('copyright')->value(Settings::locale($locale->code)->get('copyright')) }}

        @endBsMultilangualFormTabs

        @if(is_array(trans('settings.dashboard_templates')) && ! empty(trans('settings.dashboard_templates')))
            {{ BsForm::select('dashboard_template')
                    ->options(trans('settings.dashboard_templates'))
                    ->value(Settings::get('dashboard_template', config('layouts.dashboard'))) }}
        @endif

        @if(is_array(trans('settings.frontend_templates')) && ! empty(trans('settings.frontend_templates')))
            {{ BsForm::select('frontend_template')
                    ->options(trans('settings.frontend_templates'))
                    ->value(Settings::get('frontend_template', config('layouts.frontend'))) }}
        @endif

        {{ BsForm::checkbox('delete_forever')->value(1)->checked(Settings::get('delete_forever'))->withDefault() }}

        <div class="row">
            <div class="col-md-6">
                <file-uploader :media="{{ optional(Settings::instance('logo'))->getMediaResource('logo') }}"
                               name="logo"
                               :max="1"
                               collection="logo"
                               :tokens="{{ json_encode(old('logo', [])) }}"
                               label="{{ __('settings.attributes.logo') }}"
                               notes="Supported types: jpeg, png,jpg,gif"
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                ></file-uploader>
            </div>
            <div class="col-md-6">
                <file-uploader :media="{{ optional(Settings::instance('favicon'))->getMediaResource('favicon') }}"
                               name="favicon"
                               :max="1"
                               collection="favicon"
                               :tokens="{{ json_encode(old('favicon', [])) }}"
                               label="{{ __('settings.attributes.favicon') }}"
                               notes="Supported types: jpeg, png,jpg,gif"
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                ></file-uploader>
            </div>
        </div>

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
