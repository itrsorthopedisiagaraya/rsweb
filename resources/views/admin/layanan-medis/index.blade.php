@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_layanan_medis') }}
@endsection

@section('content')
    <h3>Data Layanan Medis</h3>
    <hr>
    <a href="{{ route('listLayananMedis.create') }}" class="btn btn-primary my-2">+ Tambah Layanan Medis</a>
    <table class="table table-bordered __datatables" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Url</th> 
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // datatable
            var dataTable = $('.__datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: `{{ route('listLayananMedis.getData') }}`,
                columns: [
                    {
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<img width="100" src="{{ asset('') }}files/gambar_layanan_medis/${row.image}" alt="gambar">`;
                        }
                    },
                    { data: 'judul' },
                    {
                        render: function(data, type, row, meta) {
                            var url = `{{ route('layananMedis', ':slug') }}`;
                            url = url.replace(':slug', row.slug);
                            return `<a href="${url}">
                                        <u>${url}</u>
                                    </a>`;
                        }
                    },
                    {
                        "render": function ( data, type, row ) {
                            var url = `{{ route('listLayananMedis.edit', ':id') }}`;
                            url = url.replace(':id', row.id);
                            return `<button type="button" class="btn btn-danger btn-sm list-delete" data-id="${row.id}">Delete</button>
                                    <a href="${url}" class="btn btn-sm btn-warning">Edit</a>`;
                        }
                    }
                ]
            });
            
            
            $(document).on('click', '.list-delete', function(e) {
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
                            url: `{{ route('listLayananMedis.delete') }}`,
                            type: 'POST',
                            data: {
                                _token: csrfToken,
                                id: dataId
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
                });
            });
        });
    </script>
@endsection