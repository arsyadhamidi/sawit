@extends('admin.layout.master')
@section('menuDataAutentikasi', 'active')
@section('menuDataUsersRegistrasi', 'active')
@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Users Registrasi</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-user.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-user.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Simpan Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Masukan Nama Lengkap">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                                placeholder="Masukan Username">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Pilih Status Autentikasi</label>
                            <select name="level_id" class="form-control @error('level_id') is-invalid @enderror"
                                style="width: 100%" id="selectedLevel">
                                <option value="" selected>Pilih Status Autentikasi</option>
                                @foreach ($levels as $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('level_id') == $data->id ? 'selected' : '' }}>{{ $data->namalevel ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('level_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Telepon</label>
                            <input type="number" name="telp" class="form-control @error('telp') is-invalid @enderror"
                                value="{{ old('telp') }}" placeholder="Masukan Nomor Telepon">
                            @error('telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('custom-script')
    <script>
        $(document).ready(function() {
            $('#selectedLevel').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
