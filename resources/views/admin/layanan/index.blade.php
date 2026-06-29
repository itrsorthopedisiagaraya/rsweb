@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard_layanan') }}
@endsection

@section('content')
    <style>
        #limited-content p {
            max-width: 200px;
            /* Atur lebar maksimum untuk sel */
            overflow: hidden;
            /* Sembunyikan konten yang melebihi lebar maksimum */
            white-space: nowrap;
            /* Pastikan konten tidak terpotong ke baris baru */
            text-overflow: ellipsis;
            /* Tampilkan tanda elipsis (...) jika konten terpotong */
        }
    </style>
    <h3>Layanan Unggulan</h3>
    <hr>
    <div class="d-flex justify-content-between">
        <a id="addKategori" href="{{ route('layananCreate') }}" class="btn btn-primary my-2">+ Tambah Layanan</a>
    </div>
    <div class="table-responsive">
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
    </div>
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
                columns: [{
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
                columnDefs: [{
                        "type": "html",
                        "targets": 0,
                        "render": function(data, type, row) {
                            return '<img width="100" src="{{ asset('') }}files/gambar_layanan/' +
                                row.gambar + '" alt="gambar">';
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
                                <a href="{{ route('layananEdit', ':id') }}" data-id="${row.id}" class="btn btn-sm btn-warning edit-kategori">Edit</a>
                            `;
                        }
                    }
                ]
            });

            // edit data
            $(document).on('click', '.edit-kategori', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = $(this).attr('href').replace(':id', id);
                window.location.href = url;
            });

            // delete data
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var dataId = $(this).data('id');
                        $.ajax({
                            url: `{{ route('layananDelete') }}`,
                            type: 'POST',
                            data: {
                                _token: csrfToken,
                                id: dataId
                            },
                            success: function(res) {
                                $('#layanan-table').DataTable().ajax.reload(null,
                                    false);
                                Swal.fire('Berhasil!', 'Berita berhasil dihapus.',
                                    'success');
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
