@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_dokter_jadwal') }}
@endsection

@section('content')
    <h3>Jadwal Dokter</h3>
    <hr>
    <table class="table table-bordered __datatables" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jam Kerja</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $keyD => $item) 
                <tr>
                    <td>{{ $keyD + 1 }}</td>
                    <td>{{ strtoupper($item->nama_dokter) }}</td>
                    <td>{{ strtoupper($item->nip) }}</td>
                    <td>
                    @if($item->dokterJadwal->first() != null)
                        <table class="table table-sm table-striped">
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                            </tr>
                            @foreach ($item->jamMulai as $key => $jam)
                                <tr>
                                    <td>{{ $item->hari[$key]->hari }}</td>
                                    <td>{{ $jam->jam }} - {{ $item->jamSelesai[$key]->jam }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <span class="text-warning">Jadwal Belum ditetapkan <i class="fa fa-exclamation-circle"></i></span>
                    @endif
                    </td>
                    <td>
                        <a href="{{ route('dokter.jadwal.edit', ['id' => $item->id]) }}" class="btn btn-sm btn-primary">Tetapkan Jadwal</a>
                        <a href="#" class="btn btn-sm btn-info detail" data-dokter-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#detailDokter{{ $item->id }}">Detail</a>
                        <a href="{{ route('dokter.jadwal.reset', $item->id) }}" class="btn btn-warning btn-sm">Reset Jadwal</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    {{-- {{ dd($data) }} --}}
    @foreach ($data as $item)
    <div class="modal fade" id="detailDokter{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailDokterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailDokterLabel">Detail Dokter</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <div class="d-flex justify-content-center align-center flex-column">
                                    @if ($item->foto == null || file_exists('files/foto-dokter/'.$item->foto) == false)
                                        <img class="mt-3 rounded" src="{{ asset('') }}files/foto-dokter/default.jpg" alt="" width="130">
                                    @else
                                        <img class="mt-3 rounded" src="{{ asset('') }}files/foto-dokter/{{ $item->foto }}" alt="" width="130">
                                    @endif
                                    <strong class="text-center mt-2">{{ strtoupper($item->nama_dokter) }}</strong>
                                </div>
                            </div>
                            <div class="col-8">
                                <table class="table">
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td>{{ $item->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td>Spesialis</td>
                                        <td>:</td>
                                        <td>{{ $item->spesialis }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Telp</td>
                                        <td>:</td>
                                        <td>{{ $item->no_telp }}</td>
                                    </tr>
                                </table>
                            </div>
                            <hr class="mt-3">
                            @if($item->dokterJadwal->first() != null)
                                <strong class="my-2">Jam Kerja</strong>
                                <div class="col-12">
                                    <table class="table table-striped table-sm table-jadwal-detail">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Hari</th>
                                                <th class="text-center">Jam Kerja</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <span class="text-warning">Jadwal Belum ditetapkan <i class="fa fa-exclamation-circle"></i></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.__datatables').DataTable({
                "scrollX": true,
            });
            // get flash message with sweetalert
            @if (session('success') != null)
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}'
                });
            @endif

            // ajax get jadwal
            $(document).on('click', '.detail', function (e) { 
                e.preventDefault();
                const dokter_id = $(this).data('dokter-id');
                $.ajax({
                    type: "POST",
                    url: `{{ route('api.dokter.jadwal') }}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        dokter_id: dokter_id
                    },
                    dataType: "JSON",
                    success: function (response) {
                        // clear table-jadwal-detail
                        $('.table-jadwal-detail tbody').empty();
                        // add jadwal table left
                        $.each(response.hari, function (idx, val) { 
                            console.log(val);
                            $('.table-jadwal-detail tbody').append(`
                                <tr>
                                    <td class="text-center">${val.hari}</td>
                                    <td class="text-center">${response.jam_mulai[idx].jam} - ${response.jam_selesai[idx].jam}</td>
                                </tr>
                            `);
                        });
                    }
                });
            });
        });
    </script>
@endsection