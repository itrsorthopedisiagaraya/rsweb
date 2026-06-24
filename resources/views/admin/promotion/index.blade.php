@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_promo') }}
@endsection

@section('content')

<h3>Data Postingan Promo</h3>
<hr>
<a href="{{ route('listPromo.create') }}" class="btn btn-primary my-2">+ Tambah Postingan Promo</a>
{{-- @dd($data) --}}
<table class="table table-bordered __datatables" style="width:100%">
    <thead>
        <tr>
            <th>gambar</th>
            <th>Promo</th>
            <th>Slug</th>
            <th>deadline</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody> 
        @foreach ($data as $item)
            <tr>
                <td>
                    <img src="{{ asset('') }}files/gambar_promo/{{ $item->gambar }}" alt="gambar" width="150px">
                </td>
                <td>{{ $item->judul }}</td>
                <td><a href="{{ route('promotion', ['slug' => $item->slug]) }}">{{ route('promotion', ['slug' => $item->slug]) }}</a></td>
                <td>{{ $item->deadline }}</td>
                <td>
                    <a href="{{ route('listPromo.edit', ['id' => $item->id]) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('listPromo.delete', ['id' => $item->id]) }}" method="POST" class="d-inline">
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
        $('.__datatables').DataTable({
            scrollX: true,
        });
        
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