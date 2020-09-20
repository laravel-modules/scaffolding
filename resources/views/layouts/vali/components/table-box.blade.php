<div class="tile p-0">
    @if(isset($title) || isset($tools))
        <div class="tile-title-w-btn p-4">
            <h3 class="title">{{ $title ?? '' }}</h3>
            <p>
                {{ $tools ?? '' }}
            </p>
        </div>
    @endif
    <div class="tile-body {{ $bodyClass ?? '' }}">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped table-valign-middle mb-0">
                {{ $slot }}
            </table>
        </div>
    </div>
    @isset($footer)
        <div class="tile-footer px-4 pb-2 mt-0">
            {{ $footer }}
        </div>
    @endisset
</div>
