<li class="sidebar-item {{ $menu->childrenRecursiveFiltered->count() ? 'has-submenu' : '' }}">

    {{-- Menu Link --}}
    <a href="{{ $menu->route ? route($menu->route) : $menu->url ?? '#' }}" class="sidebar-link">

        <span>
            <i class="{{ $menu->icon }}"></i>
        </span>

        <span class="hide-menu">{{ $menu->title }}</span>

        @if ($menu->childrenRecursiveFiltered->count())
            <i class="fa fa-caret-down" style="float:right;"></i>
        @endif

    </a>

    {{-- Children --}}
    @if ($menu->childrenRecursiveFiltered->count())
        <ul class="submenu collapse">

            @foreach ($menu->childrenRecursiveFiltered as $child)
                <x-sidebar.menu-item :menu="$child" />
            @endforeach

        </ul>
    @endif

</li>
