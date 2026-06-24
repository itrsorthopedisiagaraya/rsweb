@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
{{-- {{ dd($data->hari) }} --}}
<style>
    .bg-primary {
        background-color: #3f73a8;
    }
</style>
    <h3>Tetapkan Jadwal Dokter</h3>
    <hr>
    <form id="form-dokter-jadwal" action="{{ route('dokter.jadwal.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="nama" class="form-label">Dokter</label>
                        <input type="hidden" value="{{ $dokter->id }}" name="dokter">
                        <input class="form-control" type="text" value="{{ strtoupper($dokter->nama_dokter) }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <div class="form-group mb-3">
                        <label for="hari" class="form-label">Hari Kerja</label>
                        <select id="select-hari" class="form-control" id="hari" name="hari[]" multiple="multiple">
                            @foreach ($hari as $item)
                                @if ($data != null)
                                    <option {{ in_array($item->id, $jadwalHariDokter) ? 'selected' : '' }} value="{{ $item->id }}" data-code="BJ">{{ $item->hari }}</option>
                                @else
                                    <option value="{{ $item->id }}" data-code="BJ">{{ $item->hari }}</option>
                                @endif
                            @endforeach
                        </select>
                        <small class="error text-danger" id="hari-error"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" {{ $data == null ? 'hidden' : '' }}>
            <div class="col-sm-12">
                <strong class="mt-3">Jam Kerja</strong>
                <hr>
                <div class="row card-wrapper">
                    @if ($data != null)
                        @foreach ($jadwalHariDokter as $key => $item)
                            <div class="col-4" data-card-id="{{ $item }}">
                                <div class="card" style="border: 1px solid #999;">
                                    <div class="card-header text-white" style="background-color: #3f73a8;">
                                        <span class="{{ $hari->where('id', $item)->first()->hari }}"><i class="ti ti-calendar"></i>&emsp;<b>{{ $hari->where('id', $item)->first()->hari }}</b></span>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="spesialis" class="form-label">Mulai</label>
                                            <select name="jam_mulai[{{ $item }}]" class="form-control jam_mulai">
                                                <option value=""></option>
                                                @foreach ($jam as $jamItem)
                                                    @php
                                                        $selected = false;
                                                    @endphp
                                                    @foreach ($jam_kerja as $jamKerja)
                                                        @if ($jamKerja->hari_id == $item && $jamKerja->jam_mulai_id == $jamItem->id)
                                                            @php
                                                                $selected = true;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <option {{ $selected ? 'selected' : '' }} value="{{ $jamItem->id }}">{{ $jamItem->jam }}</option>
                                                @endforeach
                                            </select>
                                            <small class="error text-danger jam_mulai-error"></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="spesialis" class="form-label">Selesai</label>
                                            <select name="jam_selesai[{{ $item }}]" class="form-control jam_selesai">
                                                <option value=""></option>
                                                @foreach ($jam as $jamItem)
                                                    @php
                                                        $selected = false;
                                                    @endphp
                                                    @foreach ($jam_kerja as $jamKerja)
                                                        @if ($jamKerja->hari_id == $item && $jamKerja->jam_selesai_id == $jamItem->id)
                                                            @php
                                                                $selected = true;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <option {{ $selected ? 'selected' : '' }} value="{{ $jamItem->id }}">{{ $jamItem->jam }}</option>
                                                @endforeach
                                            </select>
                                            <small class="error text-danger jam_selesai-error"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" onclick="history.back()" class="btn btn-dark">Cancel</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#dokter').select2({placeholder: "Pilih Dokter"});
            $('#select-hari').select2({placeholder: "Pilih Hari"});
            $('.jam_mulai').select2({placeholder: "Jam Mulai"});
            $('.jam_selesai').select2({placeholder: "Jam Selesai"});

            $('#select-hari').on('change', function () {
                const hari_val = [];
                // clear card-wrapper
                // $('.card-wrapper').empty();
                // get value from select
                $(":selected", this).each(function() {
                    hari_val.push($(this).val());
                });

                // remove hidden
                if (hari_val.length > 0) {
                    $('.row').removeAttr('hidden');
                } else {
                    $('.row').attr('hidden', true);
                }

                // add element
                hari_val.forEach(element => {
                    let hari = $('#select-hari option[value="'+element+'"]').text();
                    // add element jika ada value baru tanpa merubah yang sudah ada
                    if ($(`.card-wrapper .${hari}`).length == 0) {
                        $('.card-wrapper').append(`
                            <div class="col-4" data-card-id="${element}">
                                <div class="card">
                                    <div class="card-header">
                                        <span class="${hari}"><i class="ti ti-calendar"></i>&emsp;${hari}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="spesialis" class="form-label">Mulai</label>
                                            <select name="jam_mulai[${element}]" class="form-control jam_mulai">
                                                <option value=""></option>
                                                @foreach ($jam as $item)
                                                    <option value="{{ $item->id }}">{{ $item->jam }}</option>
                                                @endforeach
                                            </select>
                                            <small class="error text-danger jam_mulai-error"></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="spesialis" class="form-label">Selesai</label>
                                            <select name="jam_selesai[${element}]" class="form-control jam_selesai">
                                                <option value=""></option>
                                                @foreach ($jam as $item)
                                                    <option value="{{ $item->id }}">{{ $item->jam }}</option>
                                                @endforeach
                                            </select>
                                            <small class="error text-danger jam_mulai-error"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                });

                // remove element
                $('.card-wrapper .col-6').each(function() {
                    let card_id = $(this).data('card-id');
                    if (!hari_val.includes(card_id.toString())) {
                        $(this).remove();
                    }
                });

                $('.jam_mulai').select2({placeholder: "Jam Mulai"});
                $('.jam_selesai').select2({placeholder: "Jam Selesai"});
            });

            var validateMulti = function(classEl) {
                var formDataMulti = {};
                var constraintsMulti = {};
                var isValid = true;
                $('.' + classEl).each(function(index, element) {
                    var obj = $(this).attr('name');
                    obj = obj.replace(/\[[^\]]*\]/g, '');
                    formDataMulti[obj] = $(this).val();

                    constraintsMulti[obj] = {
                        presence: {
                            allowEmpty: false,
                            message: "tidak boleh kosong!"
                        }
                    };
                    var errorsMulti = validate(formDataMulti, constraintsMulti);
                    if(errorsMulti) {
                        $.each(errorsMulti, function (key, val) { 
                            isValid = false;
                            $(element).nextAll('.error').text(val[0]);
                            // $(element).nextAll('.error').css('border', '1px solid red');
                        });
                    }else{
                        $(element).nextAll('.error').text('');
                    }
                });
                return isValid;
            }

            $('#form-dokter-jadwal').submit(function(e) {
                e.preventDefault();
                var formData = {
                    hari: $('#select-hari').val(),
                }

                var constraints = {
                    hari: {
                        presence: {
                            allowEmpty: false,
                            message: 'tidak boleh kosong!' 
                        }
                    }
                }

                
                var jam_mulai = validateMulti('jam_mulai');
                var jam_selesai = validateMulti('jam_selesai');
                var errors = validate(formData, constraints);
                if(errors || jam_mulai == false || jam_selesai == false) {
                    $.each(errors, function (key, val) { 
                         $(`#${key}-error`).text(val[0]);
                    });
                } else {
                    $('#form-dokter-jadwal').off('submit').submit();
                }
            });
        });
    </script>
@endsection