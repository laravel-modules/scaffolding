@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Feedback::class])
    @slot('url', route('dashboard.feedback.index'))
    @slot('name', trans('feedback.plural'))
    @slot('active', request()->routeIs('*feedback*'))
    @slot('icon', 'fas fa-envelope')
    @slot('badge', count_formatted(\App\Models\Feedback::unread()->count()) ?: null)
@endcomponent
