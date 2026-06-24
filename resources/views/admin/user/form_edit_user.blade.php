@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
{{ Breadcrumbs::render('dashboard_user_create') }}
@endsection

@section('content')
    <h3>Tambah User</h3>
    <hr>
    <form action="{{ route('user.update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $data->name }}">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" name="nip" id="nip" value="{{ $data->nip }}">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $data->jabatan }}">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ $data->username }}">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $data->email }}">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="tlp" class="form-label">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value=""></option>
                        <option {{ $data->role == 1 ? 'selected' : '' }} value="1">Super Admin</option>
                        <option {{ $data->role == 2 ? 'selected' : '' }} value="2">Admin</option>
                        <option {{ $data->role == 0 ? 'selected' : '' }} value="0">Pengguna</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="password1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password1" id="password1"  placeholder="*****">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="password2" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="*****">
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
            <button type="submit" id="form-submit" class="btn btn-primary">Submit</button>
            <button type="button" onclick="history.back()" class="btn btn-dark">Cancel</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#role').select2({
                placeholder: "Pilih Role"
            });

            // validate password match
            $('#password2').on('keyup', function() {
                if ($('#password1').val() == $('#password2').val()) {
                    $('#form-submit').attr('disabled', false);
                    $('#password2').removeClass('is-invalid');
                    $('#password2').addClass('is-valid');
                } else {
                    $('#form-submit').attr('disabled', true);
                    $('#password2').removeClass('is-valid');
                    $('#password2').addClass('is-invalid');
                }
            });
        });
    </script>
@endsection