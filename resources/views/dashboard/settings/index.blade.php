<x-layout :title="trans('settings.plural')" :breadcrumbs="['dashboard.settings.index']">
    {{ BsForm::resource('settings')->post(route('dashboard.settings.update')) }}
    @component('dashboard::components.box')
        @slot('title', trans('settings.plural'))

        @bsMultilangualFormTabs

        {{ BsForm::text('name')
                ->value(Settings::locale($locale->code)->get('name')) }}

        @endBsMultilangualFormTabs

        {{ BsForm::image('slider')->unlimited()->collection('slider')->files(
                optional(Settings::instance('slider'))->getMediaResource('slider')
        ) }}

        @bsMultilangualFormTabs
        {{ BsForm::textarea('block1')
                ->attribute('class', 'form-control textarea')
                ->value(Settings::locale($locale->code)->get('block1')) }}
        @endBsMultilangualFormTabs
        {{ BsForm::image('block1-img')->collection('block1-img')->files(
                optional(Settings::instance('block1-img'))->getMediaResource('block1-img')
        ) }}

        @bsMultilangualFormTabs
        {{ BsForm::textarea('block2')
                ->attribute('class', 'form-control textarea')
                ->value(Settings::locale($locale->code)->get('block2')) }}
        @endBsMultilangualFormTabs
        {{ BsForm::image('block2-img')->collection('block2-img')->files(
                optional(Settings::instance('block2-img'))->getMediaResource('block2-img')
        ) }}

        {{ BsForm::text('instagram')->value(Settings::get('instagram')) }}
        {{ BsForm::text('snapchat')->value(Settings::get('snapchat')) }}
        {{ BsForm::text('twitter')->value(Settings::get('twitter')) }}
        {{ BsForm::text('apple')->value(Settings::get('apple')) }}
        {{ BsForm::text('android')->value(Settings::get('android')) }}
        {{ BsForm::text('phone')->value(Settings::get('phone')) }}
        {{ BsForm::text('email')->value(Settings::get('email')) }}
        @bsMultilangualFormTabs
        {{ BsForm::text('copyright')
                ->value(Settings::locale($locale->code)->get('copyright')) }}
        @endBsMultilangualFormTabs

        @slot('footer')
            {{ BsForm::submit()->label(trans('settings.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>