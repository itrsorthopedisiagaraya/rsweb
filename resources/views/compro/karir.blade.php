@extends('compro.layouts.app')
@section('content')

<style>
    .limited-text {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Maksimal dua baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        color: #999;
    }
</style>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card my-3 shadow">
                <div class="card-header">
                    <span>Filter Kriteria</span>
                </div>
                <div class="card-body">
                    <form id="form-karir-filter">
                        @csrf
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori_list" class="form-control">
                                <option value=""></option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <span class="mb-2">Jenjang Pendidikan</span>
                            <label for="smk"><input name="pendidikan_f[]" value="SMK" class="mr-2" id="smk" type="checkbox">SMK/SMA</label>
                            <label for="d1"><input name="pendidikan_f[]" value="D1" class="mr-2" id="d1" type="checkbox">D1</label>
                            <label for="d3"><input name="pendidikan_f[]" value="D3" class="mr-2" id="d3" type="checkbox">D3</label>
                            <label for="s1"><input name="pendidikan_f[]" value="S1" class="mr-2" id="s1" type="checkbox">S1</label>
                            <label for="s2"><input name="pendidikan_f[]" value="S2" class="mr-2" id="s2" type="checkbox">S2</label>
                        </div>
                        <button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8" id="karir-list-wrapper"></div>
        <div id="modal-wrapper"></div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#kategori_list').select2({
            placeholder: "Pilih Kategori"
        });

        $('#form-karir-filter').on('submit', function(e) {
            e.preventDefault();
            let data = $(this).serializeArray();
            let kategori = $('#kategori_list').val();
            if (kategori == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pilih kategori terlebih dahulu!',
                });
                return false;
            }

            let pendidikan = [];
            $('input[name="pendidikan_f[]"]:checked').each(function() {
                pendidikan.push($(this).val());
            });

            let dataObj = {
                kategori: kategori,
                pendidikan: pendidikan,
                _token: $('input[name="_token"]').val()
            };
            getKarir(dataObj);
        });

        function getKarir(data = {kategori: null, pendidikan: null, _token: csrfToken}) {
            $('#karir-list-wrapper').empty();
            $.ajax({
                url: "{{ route('karir.admin.getAllData') }}",
                type: "POST",
                data: data,
                success: function (res) {
                    console.log(res);
                    if(res.length == 0) {
                        $('#karir-list-wrapper').append(`
                            <div class="card my-3 shadow">
                                <div class="card-body">
                                    Saat ini belum ada lowongan pekerjaan
                                </div>
                            </div>
                        `);
                    } else {
                        $.each(res, function (indexInArray, valueOfElement) { 
                            let keterangan = '';
                            if(valueOfElement.pengalaman != null) {
                                keterangan += `Minimal pengalaman ${valueOfElement.pengalaman} tahun`;
                                keterangan += `<br>`;
                                keterangan += `Berpengalaman sebagai ${valueOfElement.bidang_pengalaman}`;
                                keterangan += `<br>`;
                            }
                            keterangan += `Kriteria: ${valueOfElement.kriteria}`;
    
                            let deadline = `Deadline: ${valueOfElement.deadline}`;
    
                            let el = 
                            `<div class="card my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-9 col-sm-6">
                                            <div class="job d-flex flex-column">
                                                <span><strong id="kategori">${valueOfElement.posisi_kerja}</strong></span>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <small class="badge badge-info">${valueOfElement.kategori.kategori}</small>
                                                    </div>
                                                </div>
                                                <span class="d-flex mt-3">
                                                    <div class="location-wrapper">
                                                        <i class="fa fa-map-marker text-success" aria-hidden="true"></i>
                                                        <small>Rs. Orthopedi Siaga Raya, Jakarta Pasar Minggu</small>
                                                    </div>
                                                    <div class="graduation-wrapper ml-4">
                                                        <i class="fa fa-graduation-cap text-success" aria-hidden="true"></i>
                                                        <small id="pendidikan">${valueOfElement.pendidikan} - ${valueOfElement.jurusan}</small>
                                                    </div>
                                                </span>
                                                <div class="requirement mt-2 limited-text" id="pengalaman">
                                                    ${keterangan}
                                                </div>
                                                <a href="#" data-toggle="modal" data-target="#modal-karir-${valueOfElement.id}">Lihat selengkapnya..</a>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <a href="${valueOfElement.kategori.kategori.toLowerCase() == 'medis' ? 'https://s.id/Rekruitmennakes' : 'https://s.id/Rekruitmennonnakes'}" class="btn btn-primary btn-sm">Apply</a>
                                                <small class="mt-2" id="deadline" style="color: #999">${deadline}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            
                            let modal = 
                            `<div class="modal fade" id="modal-karir-${valueOfElement.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Karir (${valueOfElement.kategori.kategori})</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="location-wrapper">
                                                        <i class="fa fa-map-marker text-success" aria-hidden="true"></i>
                                                        <small>Rs. Orthopedi Siaga Raya, Jakarta Pasar Minggu</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="graduation-wrapper ml-4">
                                                        <i class="fa fa-graduation-cap text-success" aria-hidden="true"></i>
                                                        <small id="pendidikan">${valueOfElement.pendidikan} - ${valueOfElement.jurusan}</small>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="requirement mt-2" id="pengalaman">
                                                        ${valueOfElement.pengalaman == null ? '' : keterangan}
                                                    </div>
                                                    <div class="jobdesk mt-2" id="jobdesk">
                                                        ${valueOfElement.jobdesk}
                                                        <br>
                                                        ${valueOfElement.informasi == null ? '' : '<br>'+valueOfElement.informasi}
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                            $('#karir-list-wrapper').append(el);
                            $('#modal-wrapper').append(modal);
                        });
                    }
                }
            });
        };
        getKarir();
    });
</script>
@endsection