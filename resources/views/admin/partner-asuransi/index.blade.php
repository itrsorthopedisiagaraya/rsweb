@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_partner_asuransi') }}
@endsection

@section('content')
    <h>Daftar Partner Asuransi</h3>
    <hr>
    <a href="{{ route('partner-asuransi.create') }}" class="btn btn-primary mb-2">Tambah Partner</a>
    <div class="table-responsive">
        <table id="tablePartnerAsuransi" class="table table-striped table-bordered display no-wrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Logo</th>
                    <th>Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('') }}files/logo-partner/{{ $item->logo_partner }}" alt="logo" width="80">
                        </td>
                        <td>{{ $item->nama_partner }}</td>
                        <td><a href="{{ $item->link_partner }}">{{ $item->link_partner }}</a></td>
                        <td>
                            <a href="{{ route('partner-asuransi.edit', $item->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                            <form action="{{ route('partner-asuransi.delete', $item->id) }}" method="POST" class="d-inline form-delete-partner">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white">Hapus</button>
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
        $('#tablePartnerAsuransi').DataTable();

        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                icon: 'success',
                confirmButtonText: 'Oke'
            })
        @endif

        // swall confirm delete
        $('.form-delete-partner').on('submit', function(e){
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection