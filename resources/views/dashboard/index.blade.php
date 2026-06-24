@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
<style>
    .item-dashboard {
    border: none;
    border-radius: 10px;
    border: .5px solid #a2a2a2;
    padding: 20px;
    margin: 20px;
  }
</style>
<div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card item-dashboard">
          <h3>Status Pelayanan Pasien</h3>
          <p>Jumlah pasien yang dirawat: 75</p>
          <p>Jumlah pasien yang dipulangkan: 20</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card item-dashboard">
          <h3>Pemesanan Janji Dokter</h3>
          <p>Jumlah stok obat yang tersedia: 500</p>
          <p>Obat yang mendekati kadaluarsa: 10</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card item-dashboard">
          <h3>Statistik Obat dan Persediaan</h3>
          <p>Jumlah stok obat yang tersedia: 500</p>
          <p>Obat yang mendekati kadaluarsa: 10</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card item-dashboard">
          <h3>Kamar Rawat Inap</h3>
          <p>Kamar terisi: 30</p>
          <p>Kamar kosong: 10</p>
        </div>
      </div>
    </div>
</div>
@endsection