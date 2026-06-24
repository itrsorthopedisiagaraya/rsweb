@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
<span class="d-flex justify-content-center align-items-center">
    <a style="margin-right: 10px" href="{{ route('dashboard') }}">Dashboard</a> 
    <i style="margin-right: 10px" class="fa fa-angle-right"></i>
    <a style="margin-right: 10px" href="{{ route('postingan') }}">Postingan</a>
    <i style="margin-right: 10px" class="fa fa-angle-right"></i>
    Edit
</span>
@endsection

@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
    <h3>Edit Postingan</h3>
    <hr>
    <form action="{{ route('postingan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul" value="{{ $data->judul }}">
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">Slug</label>
                    <input type="text" class="form-control slug" value="{{ $data->slug }}" disabled>
                    <input type="hidden" name="slug" class="slug" value="{{ $data->slug }}">
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">Gambar Utama</label>
                    <input type="file" class="form-control" name="gambar_postingan">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Isi Konten</label>
                    <textarea id="editor" name="konten">{!! $data->konten !!}</textarea>
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" onclick="history.back()" class="btn btn-dark">Cancel</button>
        </div>
    </form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // create slug from judul
        $("#judul").keyup(function() {
            var judul = $("#judul").val();
            var slug = judul.replace(/\s+/g, '-').toLowerCase();
            $(".slug").val(slug);
        });

	    ClassicEditor
            .create( document.querySelector( '#editor' ), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                }
            } )
            .catch( error => {
                console.error( error );
            });
    });
</script>
@endsection