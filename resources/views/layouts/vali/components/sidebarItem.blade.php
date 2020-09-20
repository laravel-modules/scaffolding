@if(isset($can['ability'], $can['model'])
    && Gate::allows($can['ability'], $can['model'])
    || ! isset($can))
    <li class="{{ ($hasTree = isset($tree) && is_array($tree) && count($tree)) ? 'treeview' : '' }}">
        <a class="app-menu__item{{ isset($active) && $active ?  ' active' : '' }}"
           href="{{ $url ?? '#' }}" @if($hasTree) data-toggle="treeview" @endif>
            @isset($icon)
                <i class="app-menu__icon {{ $icon }}"></i>
            @endisset
            <span class="app-menu__label">{{ $name }}</span>
            @isset($badge)
                <span class="mr-1 badge badge-{{ $badgeLevel ?? 'danger' }}">{{ $badge }}</span>
            @endisset
            @if($hasTree)
                <i class="treeview-indicator fa fa-angle-right"></i>
            @endif
        </a>
        @if($hasTree)
            <ul class="treeview-menu">
                @foreach($tree as $item)
                    @if(isset($item['can']['ability'], $item['can']['model'])
                        && Gate::allows($item['can']['ability'], $item['can']['model'])
                        || ! isset($item['can']))
                        <li>
                            <a class="treeview-item{{ isset($item['active']) && $item['active'] ? ' active' : '' }}"
                               href="{{ $item['url'] }}">
                                <i class="mr-2 far fa-circle nav-icon"></i>
                                {{ $item['name'] }}

                                @isset($item['badge'])
                                    <span class="flex-grow-1">
                                        <span class="mr-1 float-right badge badge-{{ $item['badgeLevel'] ?? 'danger' }}">{{ $item['badge'] }}</span>
                                    </span>
                                @endisset
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </li>
@endif
