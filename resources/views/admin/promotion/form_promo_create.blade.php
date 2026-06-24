@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_promo_create') }}
@endsection

@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
    <h3>Tambah Promo</h3>
    <hr>
    <form action="{{ route('listPromo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="promo" class="form-label">Judul Promo</label>
                    <input type="text" class="form-control" id="promo" name="promo">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control slug" disabled>
                    <input type="text" class="form-control slug" id="slug" name="slug" hidden>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>
                <div class="mb-3">
                    <label for="deadline" class="form-label">Tenggal Akhir Promo</label>
                    <input type="text" class="form-control" id="deadline" name="deadline" autocomplete="off">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="konten" class="form-label">Konten</label>
                    <textarea type="text" class="form-control" id="konten" name="konten"></textarea>
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
        $("#promo").keyup(function() {
            var judul = $("#promo").val();
            var slug = judul.replace(/\s+/g, '-').toLowerCase();
            $(".slug").val(slug);
        });

        $('#deadline').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        ClassicEditor
            .create( document.querySelector( '#konten' ), {
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