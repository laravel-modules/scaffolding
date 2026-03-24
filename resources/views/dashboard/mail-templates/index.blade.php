<x-layout :title="__('mail-templates.plural')" :breadcrumbs="['dashboard.mail-templates.index']">
    @include('dashboard.errors')
    @include('dashboard.mail-templates.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('mail-templates.actions.list') ({{ $mailTemplates->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
              <div class="d-flex justify-content-between">
                  <div class="d-flex" style="gap: .5rem">
                      @include('dashboard.mail-templates.partials.actions.create')

                      <x-excel-export model="App\Models\MailTemplate"></x-excel-export>
                      <x-excel-import model="App\Models\MailTemplate"></x-excel-import>
                      @include('dashboard.mail-templates.partials.actions.trashed')
                  </div>
                  <div>
                      <x-check-all-delete
                              type="{{ \App\Models\MailTemplate::class }}"
                              :resource="__('mail-templates.plural')"></x-check-all-delete>
                  </div>
              </div>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
              <x-check-all></x-check-all>
            </th>
            <th>@lang('mail-templates.attributes.name')</th>
            <th>@lang('mail-templates.attributes.subject')</th>
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
                    <a href="{{ route('dashboard.mail-templates.show', $mailTemplate) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $mailTemplate->name }}
                    </a>
                </td>
                <td>{{ $mailTemplate->subject }}</td>

                <td style="width: 160px">
                    @include('dashboard.mail-templates.partials.actions.show')
                    @include('dashboard.mail-templates.partials.actions.edit')
                    @include('dashboard.mail-templates.partials.actions.delete')
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
