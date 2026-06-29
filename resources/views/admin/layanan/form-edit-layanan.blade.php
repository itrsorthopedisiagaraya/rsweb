@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard_layanan_create') }}
@endsection

@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
    <h3>Edit Layanan</h3>
    <hr>
    <form action="{{ route('layananUpdate', $layanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="layanan" class="form-label">Nama Layanan</label>
                    <input type="text" class="form-control" name="layanan" id="layanan" placeholder="..."
                        value="{{ $layanan->layanan }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="konten" class="form-label">Isi Konten</label>
                    <textarea id="editor1" name="konten">{{ $layanan->konten }}</textarea>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" onclick="history.back()" class="btn btn-dark">Cancel</button>
            </div>
        </div>
    </form>
@endsection
