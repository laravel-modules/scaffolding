<x-layout :title="$mailTemplate->name" :breadcrumbs="['dashboard.mail-templates.show', $mailTemplate]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('mail-templates.attributes.name')</th>
                        <td>{{ $mailTemplate->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('mail-templates.attributes.model_type')</th>
                        <td>{{ data_get(\App\Models\MailTemplate::types(), $mailTemplate->model_type) }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('mail-templates.attributes.subject')</th>
                        <td>{{ $mailTemplate->subject }}</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.mail-templates.partials.actions.edit')
                    @include('dashboard.mail-templates.partials.actions.delete')
                    @include('dashboard.mail-templates.partials.actions.restore')
                    @include('dashboard.mail-templates.partials.actions.forceDelete')
                @endslot
            @endcomponent
        </div>
        <div class="col-md-6">
            @component('dashboard::components.box', ['title' => __('mail-templates.attributes.content')])
                @slot('class', 'p-0')
                {!! $mailTemplate->content !!}
            @endcomponent
        </div>
    </div>
</x-layout>
