@extends('admin.layout.master')
@section('menuDataMaster', 'active')
@section('menuDataPetani', 'active')
@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Petani</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-petani.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-petani.index') }}" class="btn btn-primary">
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
                            <label>Pilih Users Registrasi</label>
                            <select name="users_id" class="form-control @error('users_id') is-invalid @enderror"
                                style="width: 100%" id="selectedUser">
                                <option value="" selected>Pilih Users Registrasi</option>
                                @foreach ($users as $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('users_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->level->namalevel ?? '-' }} - {{ $data->name ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('users_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}" placeholder="Masukan Nama Lengkap">
                            @error('nama')
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
                        <div class="mb-3">
                            <label>Alamat Domisili</label>
                            <textarea name="alamat_domisili" class="form-control @error('alamat_domisili') is-invalid @enderror" rows="5"
                                placeholder="Masukan alamat domisili">{{ old('alamat_domisili') }}</textarea>
                            @error('alamat_domisili')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Alamat Kebun</label>
                            <textarea name="alamat_kebun" class="form-control @error('alamat_kebun') is-invalid @enderror" rows="5"
                                placeholder="Masukan alamat kebun">{{ old('alamat_kebun') }}</textarea>
                            @error('alamat_kebun')
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
            $('#selectedUser').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
