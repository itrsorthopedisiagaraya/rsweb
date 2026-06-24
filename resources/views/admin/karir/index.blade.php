@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_karir') }}
@endsection

@section('content')

<h3>Data Postingan Karir</h3>
<hr>
<a href="{{ route('karir.admin.create') }}" class="btn btn-primary my-2">+ Tambah Postingan Karir</a>
<table class="table table-bordered __datatables" style="width:100%">
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Pendidikan</th>
            <th>Min. Pengalaman</th>
            <th>Keriteria</th>
            <th>Jobdesk</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody> 
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->kategori->kategori }}</td>
                <td>{{ $item->pendidikan }}</td>
                <td>{{ $item->pengalaman }} Tahun</td>
                <td>{{ $item->kriteria }}</td>
                <td>{{ $item->jobdesk }}</td>
                <td>
                    <a href="{{ route('karir.admin.edit', ['id' => $item->id]) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('karir.admin.destroy', ['id' => $item->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger karir-delete">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.__datatables').DataTable();

        $('.karir-delete').click(function (e) { 
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
    });
</script>
@endsection