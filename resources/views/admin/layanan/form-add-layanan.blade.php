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
    <h3>Tambah Layanan</h3>
    <hr>
    <form action="{{ route('layananStore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="layanan" class="form-label">Nama Layanan</label>
                    <input type="text" class="form-control" name="layanan" id="layanan" placeholder="...">
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
                    <label for="jabatan" class="form-label">Isi Konten</label>
                    <textarea id="editor" name="konten"></textarea>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" onclick="history.back()" class="btn btn-dark">Cancel</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create( document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                }
            })
            .catch( error => {
                console.error( error );
            });
    </script>
@endsection