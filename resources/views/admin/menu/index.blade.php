@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard_menu') }}
@endsection

@section('content')
    <h3>Data Menu</h3>
    <hr>
    <a href="{{ route('menu.create') }}" class="btn btn-primary my-2">+ Tambah Menu</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <hr>

    <ul class="list-group">

        @foreach ($menus as $menu)
            @include('admin.menu.partials.menu-item', ['menu' => $menu])
        @endforeach

    </ul>

@endsection
