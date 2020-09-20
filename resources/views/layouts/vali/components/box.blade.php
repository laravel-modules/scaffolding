<div class="tile">
    @if(isset($title) || isset($tools))
        <div class="tile-title-w-btn">
            <h3 class="title">{{ $title ?? '' }}</h3>
            <p>
                {{ $tools ?? '' }}
            </p>
        </div>
    @endif
    <div class="tile-body {{ $bodyClass ?? '' }}">
        {{ $slot }}
    </div>
        @isset($footer)
            <div class="tile-footer px-4 pb-2">
                {{ $footer }}
            </div>
        @endisset
</div>