@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_dokter') }}
@endsection

@section('content')
    <h3>Dokter Aktif</h3>
    <hr>
    <a href="{{ route('dokter.create') }}" class="btn btn-primary my-2">+ Tambah Dokter</a>
    <table class="table table-bordered __datatables" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Spesialis</th>
                <th>No.Tlp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)   
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        @if ($item->foto == null || file_exists('files/foto-dokter/'.$item->foto) == false)
                            <img class="rounded" src="{{ asset('') }}files/foto-dokter/default.jpg" alt="pict" width="50">
                        @else
                            <img class="rounded" src="{{ asset('') }}files/foto-dokter/{{ $item->foto }}" alt="pict" width="50">
                        @endif
                    </td>
                    <td>{{ $item->nama_dokter }}</td>
                    <td>{{ $item->spesialis }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>
                        <form action="{{ route('dokter.delete', ['id' => $item->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm dokter-delete">Delete</button>
                        </form>
                        <a href="{{ route('dokter.edit', ['id' => $item->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.__datatables').DataTable({
                "scrollX": true,
            });

            // confirm delete with sweetalert
            $('.dokter-delete').click(function (e) { 
                e.preventDefault();
                const form = $(this).closest('form');
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
                        form.submit();
                    }
                });
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