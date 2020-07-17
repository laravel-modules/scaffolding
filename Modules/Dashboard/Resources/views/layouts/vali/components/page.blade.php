<div class="app-title">
    <div>
        <h1>{{ $title }}</h1>
    </div>
    @isset($breadcrumbs)
        {{ Breadcrumbs::render(...$breadcrumbs) }}
    @endisset
</div>
@include('flash::message')
{{ $slot }}