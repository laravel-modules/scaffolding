<x-layout :title="$feedback->name" :breadcrumbs="['dashboard.feedback.show', $feedback]">
    <div class="row">
        <div class="col-md-12">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('feedback.attributes.name')</th>
                        <td>{{ $feedback->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('feedback.attributes.phone')</th>
                        <td>{{ $feedback->phone }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('feedback.attributes.email')</th>
                        <td>{{ $feedback->email }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('feedback.attributes.message')</th>
                        <td>{{ $feedback->message }}</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.feedback.partials.actions.delete')
                    @include('dashboard.feedback.partials.actions.restore')
                    @include('dashboard.feedback.partials.actions.forceDelete')
                @endslot
            @endcomponent
        </div>
    </div>
</x-layout>
