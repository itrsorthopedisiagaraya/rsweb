@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard_aboutus') }}
@endsection

@section('content')
    <h3>Data Tentang Kami</h3>
    <hr>
    <a href="{{ route('aboutus.create') }}" class="btn btn-primary my-2">+ Tambah Tentang Kami</a>
    <div class="table-responsive">
        <table class="table table-bordered __datatables" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Url</th>
                    <th>Sembunyikan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var dataTable = $('.__datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ route('getAboutus') }}`,
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'gambar',
                        render: function(data, type, row, meta) {
                            if (!data || String(data).trim() === '') {
                                return `<span class="text-muted fst-italic">No image</span>`;
                            }
                            return `<img width="100" src="{{ asset('') }}files/gambar_aboutus/${row.gambar}" alt="gambar">`;
                        }
                    },
                    {
                        data: 'judul'
                    },
                    {
                        render: function(data, type, row, meta) {
                            var url = `{{ route('about.details', ':id') }}`;
                            url = url.replace(':id', row.slug);
                            return `<a href="${url}">
                                        <u>${url}</u>
                                    </a>`;
                        }
                    },
                    {
                        data: 'disabled',
                        render: function(data, type, row) {
                            return data ? 'Ya' : 'Tidak';
                        }
                    },
                    {
                        "render": function(data, type, row) {
                            var url = `{{ route('aboutus.edit', ':id') }}`;
                            url = url.replace(':id', row.id);
                            return `<button type="button" class="btn btn-danger btn-sm user-delete" data-id="${row.id}">Delete</button>
                                    <a href="{{ url('') }}/aboutus/edit/${row.id}" class="btn btn-sm btn-warning">Edit</a>`;
                        }
                    }
                ],
            });

            // confirm delete with sweetalert
            $(document).on('click', '.user-delete', function(e) {
                e.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Ambil ID
                        var postId = $(this).data('id');

                        // Kirim permintaan AJAX untuk menghapus data
                        $.ajax({
                            url: '{{ route('aboutus.delete') }}',
                            method: 'POST',
                            data: {
                                _token: csrfToken,
                                id: postId
                            },
                            success: function(res) {
                                dataTable.ajax.reload(null, false);
                                Swal.fire('Berhasil!', 'Tentang Kami berhasil dihapus.',
                                    'success');
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error');
                            }
                        });
                    }
                })
            });

            // get flash message with sweetalert
            @if (session('success') != null)
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}'
                });
            @endif
        });
    </script>
@endsection
