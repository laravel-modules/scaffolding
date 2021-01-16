<x-layout :title="trans('settings.tabs.terms')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->patch(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')
        @bsMultilangualFormTabs
        {{ BsForm::textarea('terms')
            ->attribute('class', 'form-control textarea')
            ->value(Settings::locale($locale->code)->get('terms')) }}
        @endBsMultilangualFormTabs

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>