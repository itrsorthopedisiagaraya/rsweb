@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')

    <h3>Edit Menu</h3>
    <hr>

    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $menu->title }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Icon</label>
                <input type="text" name="icon" class="form-control" value="{{ $menu->icon }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Route Name</label>
                <input type="text" name="route" class="form-control" value="{{ $menu->route }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>URL (optional)</label>
                <input type="text" name="url" class="form-control" value="{{ $menu->url }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Parent Menu</label>
                <select name="parent_id" class="form-control">

                    <option value="">-- Root Menu --</option>

                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>
                            {{ $parent->title }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ $menu->sort_order }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Status</label><br>
                <input type="checkbox" name="is_active" value="1" {{ $menu->is_active ? 'checked' : '' }}>
                Active
            </div>

        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Cancel</a>

    </form>

@endsection
