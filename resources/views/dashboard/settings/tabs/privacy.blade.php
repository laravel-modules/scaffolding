<x-layout :title="trans('settings.tabs.privacy')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')
        @bsMultilangualFormTabs
        {{ BsForm::textarea('privacy')
            ->attribute('class', 'form-control textarea')
            ->value(Settings::locale($locale->code)->get('privacy')) }}
        @endBsMultilangualFormTabs

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>