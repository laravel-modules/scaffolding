<x-layout :title="__('mail-templates.trashed')" :breadcrumbs="['dashboard.mail-templates.trashed']">
    @include('dashboard.mail-templates.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('mail-templates.actions.list') ({{ $mailTemplates->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
            <x-check-all-force-delete
                    type="{{ \App\Models\MailTemplate::class }}"
                    :resource="__('mail-templates.plural')"></x-check-all-force-delete>
            <x-check-all-restore
                    type="{{ \App\Models\MailTemplate::class }}"
                    :resource="__('mail-templates.plural')"></x-check-all-restore>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
              <x-check-all></x-check-all>
            </th>
            <th>@lang('mail-templates.attributes.name')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($mailTemplates as $mailTemplate)
            <tr>
                <td class="text-center">
                  <x-check-all-item :model="$mailTemplate"></x-check-all-item>
                </td>
                <td>
                    <a href="{{ route('dashboard.mail-templates.trashed.show', $mailTemplate) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $mailTemplate->name }}
                    </a>
                </td>

                <td style="width: 160px">
                    @include('dashboard.mail-templates.partials.actions.show')
                    @include('dashboard.mail-templates.partials.actions.restore')
                    @include('dashboard.mail-templates.partials.actions.forceDelete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('mail-templates.empty')</td>
            </tr>
        @endforelse

        @if($mailTemplates->hasPages())
            @slot('footer')
                {{ $mailTemplates->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
