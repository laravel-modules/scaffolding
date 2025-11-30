<x-layout :title="trans('settings.tabs.about')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')
        @multilingualFormTabs
        {{ BsForm::textarea('about')
            ->attribute('class', 'form-control textarea')
            ->value(Settings::locale($locale->getCode())->get('about')) }}
        @endMultilingualFormTabs

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
