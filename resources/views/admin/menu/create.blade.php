@extends('layouts.app')

@section('title', 'Create Menu')

@section('content')

    <h3>Create Menu</h3>
    <hr>

    <form action="{{ route('menu.store') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Icon</label>
                <input type="text" name="icon" class="form-control" placeholder="fa fa-home">
            </div>

            <div class="col-md-6 mb-3">
                <label>Route Name</label>
                <input type="text" name="route" class="form-control" placeholder="dashboard">
            </div>

            <div class="col-md-6 mb-3">
                <label>URL (optional)</label>
                <input type="text" name="url" class="form-control" placeholder="/custom-url">
            </div>

            <div class="col-md-6 mb-3">
                <label>Parent Menu</label>
                <select name="parent_id" class="form-control">
                    <option value="">-- Root Menu --</option>

                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">
                            {{ $parent->title }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>

            <div class="col-md-6 mb-3">
                <label>Status</label><br>
                <input type="checkbox" name="is_active" value="1" checked>
                Active
            </div>

        </div>

        <button class="btn btn-primary">Save</button>
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Cancel</a>

    </form>

@endsection
