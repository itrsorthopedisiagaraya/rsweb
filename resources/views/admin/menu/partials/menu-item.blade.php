<li class="list-group-item">

    <div class="d-flex justify-content-between align-items-center">

        <div>
            <i class="{{ $menu->icon }}"></i>
            <strong>{{ $menu->title }}</strong>

            <small class="text-muted">
                (Order: {{ $menu->sort_order }})
            </small>

            @if (!$menu->is_active)
                <span class="badge bg-danger">Inactive</span>
            @else
                <span class="badge bg-success">Active</span>
            @endif
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-warning">
                Edit
            </a>

            <form action="{{ route('menu.delete', $menu->id) }}" method="POST"
                onsubmit="return confirm('Delete this menu?')">

                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger">
                    Delete
                </button>

            </form>

        </div>

    </div>

    {{-- CHILDREN --}}
    @if ($menu->childrenRecursive->count())

        <ul class="list-group mt-2 ms-4">

            @foreach ($menu->childrenRecursive as $child)
                @include('admin.menu.partials.menu-item', ['menu' => $child])
            @endforeach

        </ul>

    @endif

</li>
