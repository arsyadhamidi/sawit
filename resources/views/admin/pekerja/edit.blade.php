@extends('admin.layout.master')
@section('menuDataMaster', 'active')
@section('menuDataPekerja', 'active')
@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Pekerja</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-pekerja.update', $pekerjas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-pekerja.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Simpan Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Pilih Status</label>
                                    <select name="level_id" class="form-control @error('level_id') is-invalid @enderror"
                                        style="width: 100%" id="selectedLevel">
                                        <option value="" selected>Pilih Status</option>
                                        @foreach ($levels as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $pekerjas->level_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->namalevel ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('level_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label>Nomor Induk Kependudukan (NIK)</label>
                                        <input type="number" name="nik"
                                            class="form-control @error('nik') is-invalid @enderror"
                                            value="{{ old('nik', $pekerjas->nik ?? '-') }}"
                                            placeholder="Masukan Nomor Induk Kependudukan" readonly>
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama', $pekerjas->nama ?? '-') }}"
                                        placeholder="Masukan Nama Lengkap">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Nomor Telepon</label>
                                    <input type="number" name="telp"
                                        class="form-control @error('telp') is-invalid @enderror"
                                        value="{{ old('telp', $pekerjas->telp ?? '-') }}"
                                        placeholder="Masukan nomor telepon">
                                    @error('telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>SIM</label>
                                    <input type="number" name="sim"
                                        class="form-control @error('sim') is-invalid @enderror"
                                        value="{{ old('sim', $pekerjas->sim ?? '-') }}" placeholder="Masukan nomor sim">
                                    @error('sim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="5"
                                        placeholder="Masukan alamat domisili">{{ old('alamat', $pekerjas->alamat ?? '-') }}</textarea>
                                    @error('sim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Foto Pekerja</label>
                                    <input type="file" name="foto_pekerja"
                                        class="form-control @error('foto_pekerja') is-invalid @enderror">
                                    @error('foto_pekerja')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
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
