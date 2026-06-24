@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_partner_asuransi_create') }}
@endsection

@section('content')
    <h3>Tambah Partner</h3>
    <hr>
    
    <form action="{{ route('partner-asuransi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Partner <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="...">
                    @error('nama')
                        <small class="text-danger">Nama partner harus di isi.</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo Partner <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="logo">
                    @error('logo')
                        <small class="text-danger">Logo partner harus di isi.</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Link Partner</label>
                    <input type="text" class="form-control" name="link" placeholder="...">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <textarea id="editor" name="desc" class="form-control"></textarea>
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
    
</script>
@endsection