@extends('compro.layouts.app')
@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-body">
                <h3>Jadwal Praktek</h3>
                <small>{{ $hari }}, {{ date('d F Y') }}</small>
                <hr>
                <table class="table table-bordered" id="tableJadwalDokter">
                    <thead>
                        <tr>
                            <td>No.</td>    
                            <td>Spesialis</td>
                            <td>Nama Dokter</td>
                            <td>Jam Kerja</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwal as $key => $dt)
                            @if (isset($dt->dokter))  
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $dt->dokter->spesialis }}</td>
                                    <td>{{ $dt->dokter->nama_dokter }}</td>
                                    <td>{{ $dt->jamMulai->jam }} - {{ $dt->jamSelesai->jam }}</td>
                                    <td>
                                        <a type="button" class="badge badge-info badge-sm text-white" data-toggle="modal" data-target="#detailDokter{{ $dt->dokter->id }}">
                                            <i class="fa fa-eye text-white"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach ($jadwal as $dt)
        @if (isset($dt->dokter))
            <div class="modal fade" id="detailDokter{{ $dt->dokter->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Dokter Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="d-flex justify-content-center align-items-center flex-column">
                                                @if ($dt->dokter->foto == null || file_exists('files/foto-dokter/'.$dt->dokter->foto) == false)
                                                    <img class="rounded text-center" src="{{ asset('') }}files/foto-dokter/default.jpg" alt="pict" width="150">
                                                @else
                                                    <img class="rounded text-center" src="{{ asset('') }}files/foto-dokter/{{ $dt->dokter->foto }}" alt="pict" width="150">
                                                @endif
                                                <small class="text-center mt-2"><strong>{{ strtoupper($dt->dokter->nama_dokter) }}</strong></small>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="d-flex flex-column ml-3">
                                                <label class="form-label py-2" style="font-size: 14px;">
                                                    NIP :
                                                    <span>{{ $dt->dokter->nip }}</span>
                                                </label>
                                                <label class="form-label py-2" style="font-size: 14px;">
                                                    Spesialis :
                                                    <span>{{ $dt->dokter->spesialis }}</span>
                                                </label>
                                                <label class="form-label py-2" style="font-size: 14px;">
                                                    Lulusan :
                                                    <span>Universitas *****</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr class="mt-3">
                                            <div class="d-flex justify-content-center align-center flex-column">
                                                <strong class="my-2 text-center">Jadwal Praktik</strong>
                                                <table class="table table-striped table-sm table-jadwal-detail">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Hari</th>
                                                            <th class="text-center">Jam Kerja</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">{{ $dt->hari->hari }}</td>
                                                            <td class="text-center">
                                                                {{ $dt->jamMulai->jam }} - {{ $dt->jamSelesai->jam }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('script')
    <script>
        $('#tableJadwalDokter').DataTable();
    </script>
@endsection