@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_karir_edit') }}
@endsection

@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
    <h3>Edit Karir</h3>
    <hr>
    <form action="{{ route('karir.admin.update') }}" method="POST">
        @csrf
        @foreach($karir as $item)
        <input type="text" name="id_karir" value="{{ $item->id }}" hidden>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-4">
                            <label for="posisi" class="form-label">Posisi Lowongan</label>
                            <input type="text" class="form-control" value="{{ $item->posisi_kerja }}" name="posisi">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-4 form-group d-flex flex-column">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="select2">
                        <option value=""></option>
                        @foreach ($kategori as $k)
                            <option {{ $item->kategori->id == $k->id ? 'selected="selected"' : '' }} value="{{ $k->id }}">{{ $k->kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pengalaman" class="form-label">Min. Lama Pengalaman (tahun)</label>
                    <input type="number" class="form-control" value="{{ $item->pengalaman }}" id="pengalaman" name="pengalaman">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">Min. Pendidikan</label>
                            <select class="form-control select2" id="pendidikan" name="pendidikan">
                                <option value=""></option>
                                <option {{ $item->pendidikan == 'SMA' ? 'selected="selected"' : '' }} value="SMA">SMA/SMK</option>
                                <option {{ $item->pendidikan == 'D1' ? 'selected="selected"' : '' }} value="D1">D1</option>
                                <option {{ $item->pendidikan == 'D3' ? 'selected="selected"' : '' }} value="D3">D3</option>
                                <option {{ $item->pendidikan == 'S1' ? 'selected="selected"' : '' }} value="S1">S1</option>
                                <option {{ $item->pendidikan == 'S2' ? 'selected="selected"' : '' }} value="S2">S2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan Pendidikan</label>
                            <input type="text" class="form-control" value="{{ $item->jurusan }}" id="jurusan" name="jurusan">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="bidang_pengalaman" class="form-label">Bidang Pengalaman</label>
                    <input type="text" class="form-control" value="{{ $item->bidang_pengalaman }}" id="bidang_pengalaman" name="bidang_pengalaman">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb-3">
                    <label for="kriteria" class="form-label">Kriteria</label>
                    <textarea type="text" class="form-control" id="kriteria" name="kriteria">{{ $item->kriteria }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="informasi" class="form-label">Informasi Tambahan</label>
                    <textarea id="informasi" class="form-control" name="informasi">{{ $item->informasi }}</textarea>
                </div>
            </div>
            <div class="col-sm-4">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="text" name="deadline" id="deadline" value="{{ $item->deadline }}" class="form-control">
            </div>
        </div>
        @endforeach
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" onclick="history.back()" class="btn btn-dark">Cancel</button>
        </div>
    </form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#kategori').select2({
            placeholder: "Pilih Kategori"
        });

        $('#deadline').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
@endsection