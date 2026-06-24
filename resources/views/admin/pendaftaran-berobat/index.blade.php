@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_postingan') }}
@endsection

@section('content')
    <h3>List Pendaftaran Berobat</h3>
    <hr>
    <table class="table table-bordered __datatables" id="kategori-table" style="width:100%">
        <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>Nama Dokter</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal Periksa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($data as $dt)
                <tr>
                    <td>{{ $dt->user->name }}</td>
                    <td>{{ $dt->dokter->nama_dokter }}</td>
                    <td>{{ $dt->metode_pembayaran }}</td>
                    <td>{{ $dt->tanggal_periksa }}</td>
                    <td>
                        <a href="{{route('detailPasien', ['id' => $dt->id])}}" target="_blank" type="button" class="btn btn-info btn-sm">Detail</a>
                        <button type="button" class="btn btn-danger btn-sm">Approve</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection