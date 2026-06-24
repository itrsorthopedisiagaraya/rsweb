@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_postingan') }}
@endsection

@section('content')
    <h3>Data Postingan Berita</h3>
    <hr>
    <a href="{{ route('postingan.create') }}" class="btn btn-primary my-2">+ Tambah Postingan Berita</a>
    <table class="table table-bordered __datatables" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Url</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var dataTable = $('.__datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ route('getBerita') }}`,
                columns: [
                    {
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<img width="100" src="{{ asset('') }}files/gambar_postingan/banner/${row.gambar}" alt="gambar">`;
                        }
                    },
                    { data: 'judul' },
                    {
                        render: function(data, type, row, meta) {
                            var url = `{{ route('post', ':id') }}`;
                            url = url.replace(':id', row.id);
                            return `<a href="${url}">
                                        <u>${url}</u>
                                    </a>`;
                        }
                    },
                    { data: 'status' },
                    {
                        "render": function ( data, type, row ) {
                            var url = `{{ route('postingan.edit', ':id') }}`;
                            url = url.replace(':id', row.id);
                            return `<button type="button" class="btn btn-danger btn-sm user-delete" data-id="${row.id}">Delete</button>
                                    <a href="{{ url('') }}/postingan/edit/${row.id}" class="btn btn-sm btn-warning">Edit</a>`;
                        }
                    }
                ],
            });

            // confirm delete with sweetalert
            $(document).on('click', '.user-delete', function (e) { 
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
                            url: '{{ route("postingan.delete") }}',
                            method: 'POST',
                            data: { 
                                _token: csrfToken,
                                id: postId 
                            }, 
                            success: function(res) {
                                dataTable.ajax.reload(null, false);
                                Swal.fire('Berhasil!', 'Berita berhasil dihapus.', 'success');
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
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