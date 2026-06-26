@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard_pesan') }}
@endsection

@section('content')
    <h3>Data Pesan</h3>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered __datatables" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Subjek</th>
                    <th>Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesan as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->subjek }}</td>
                        <td>{{ $item->pesan }}</td>
                        <td>
                            <form action="{{ route('pesan.delete', ['id' => $item->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm pesan-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.__datatables').DataTable({
                "scrollX": true,
            });

            $('.pesan-delete').click(function() {
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
