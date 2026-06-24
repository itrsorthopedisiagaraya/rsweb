@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_layanan') }}
@endsection

@section('content')
    <style>
        #limited-content p {
    max-width: 200px; /* Atur lebar maksimum untuk sel */
    overflow: hidden; /* Sembunyikan konten yang melebihi lebar maksimum */
    white-space: nowrap; /* Pastikan konten tidak terpotong ke baris baru */
    text-overflow: ellipsis; /* Tampilkan tanda elipsis (...) jika konten terpotong */
}
    </style>
    <h3>Layanan Unggulan</h3>
    <hr>
    <div class="d-flex justify-content-between">
        <a id="addKategori" href="{{ route('layananCreate') }}" class="btn btn-primary my-2">+ Tambah Layanan</a>
    </div>
    <table class="table table-bordered __datatables" id="layanan-table" style="width:100%">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Layanan</th>
                <th>Isi layanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody> 
            
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // get flash message with sweetalert
            @if (session('success') != null)
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('message') }}'
                });
            @endif

            $('#layanan-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    data: function(d) {
                        d._token = "{{ csrf_token() }}" 
                    },
                    url: '{{ route('getLayanan') }}',
                    type: 'POST'
                },
                columns: [
                    {
                        data: 'gambar',
                        name: 'gambar',
                        width: '25%',
                    },
                    {
                        data: 'layanan',
                        name: 'layanan',
                        width: '25%',
                    },
                    {
                        data: 'konten',
                        name: 'konten',
                        width: '30%',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],
                columnDefs: [
                    {
                        "type": "html",
                        "targets": 0,
                        "render": function(data, type, row) {
                            return '<img width="100" src="{{ asset('') }}files/gambar_layanan/'+ row.gambar +'" alt="gambar">';
                        }
                    },
                    {
                        "sorting": true,
                        "orderable": true,
                        "type": "html",
                        "targets": 1,
                        // "data": id,
                        "render": function(data, type, row) {
                            return row.layanan;
                        }
                    },
                    {
                        "type": "html",
                        "targets": 2,
                        "render": function(data, type, row) {
                            return `
                                <span id="limited-content">${row.konten}</span>
                            `;
                        }
                    },
                    {
                        "sorting": false,
                        "orderable": false,
                        "type": "html",
                        "targets": 3,
                        // "data": id,
                        "render": function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                                <button class="btn btn-sm btn-warning edit-kategori" id="" data-bs-toggle="modal" data-bs-target="#editKategori" data-id="${row.id}">Edit</button>
                            `;
                        }
                    }
                ]
            });
        });
    </script>
@endsection