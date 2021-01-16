<x-layout :title="trans('settings.tabs.about')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')
        @bsMultilangualFormTabs
        {{ BsForm::textarea('about')
            ->attribute('class', 'form-control textarea')
            ->value(Settings::locale($locale->code)->get('about')) }}
        @endBsMultilangualFormTabs

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>