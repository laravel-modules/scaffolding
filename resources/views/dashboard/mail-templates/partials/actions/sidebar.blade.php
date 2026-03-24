@if(! empty(\App\Models\MailTemplate::types()) && Gate::allows('viewAny', \App\Models\MailTemplate::class))
    @component('dashboard::components.sidebarItem')
        @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\MailTemplate::class])
        @slot('url', route('dashboard.mail-templates.index'))
        @slot('name', __('emails.management'))
        @slot('active', request()->routeIs('*mail-templates*') || request()->routeIs('*emails*'))
        @slot('icon', 'fas fa-envelope')
        @slot('tree', [
        [
            'name' => __('mail-templates.plural'),
            'url' => route('dashboard.mail-templates.index'),
            'active' => request()->routeIs('*mail-templates*'),
        ],
        [
            'name' => __('emails.jobs'),
            'url' => route('dashboard.emails.index'),
            'active' => request()->routeIs('*emails*'),
        ],
        [
            'name' => __('emails.settings'),
            'url' => route('dashboard.settings.index', ['tab' => 'mail']),
            'active' => request()->routeIs('*settings*') && request('tab') == 'mail',
        ],

    ])
    @endcomponent
@endif
