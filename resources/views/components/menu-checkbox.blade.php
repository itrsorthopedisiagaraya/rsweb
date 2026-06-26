<li class="list-unstyled mb-1">

    <label>

        <input type="checkbox" name="menus[]" value="{{ $menu->id }}"
            {{ isset($selectedMenus) && in_array($menu->id, $selectedMenus) ? 'checked' : '' }}>

        <i class="{{ $menu->icon }}"></i>

        {{ $menu->title }}

    </label>

    @if ($menu->children->count())

        <ul style="margin-left:30px">

            @foreach ($menu->children as $child)
                <x-menu-checkbox :menu="$child" :selectedMenus="$selectedMenus ?? []" />
            @endforeach

        </ul>

    @endif

</li>
