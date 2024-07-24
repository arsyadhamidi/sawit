@extends('admin.layout.master')
@section('menuDashboard', 'active')

@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Biodata Petani</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('update-biodatapetani.update', $petanis->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="/dashboard" class="btn btn-primary">
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
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $petanis->nama ?? '-') }}" placeholder="Masukan Nama Lengkap">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Telepon</label>
                            <input type="number" name="telp" class="form-control @error('telp') is-invalid @enderror"
                                value="{{ old('telp', $petanis->telp ?? '-') }}" placeholder="Masukan Nomor Telepon">
                            @error('telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Alamat Domisili</label>
                            <textarea name="alamat_domisili" class="form-control @error('alamat_domisili') is-invalid @enderror" rows="5"
                                placeholder="Masukan alamat domisili">{{ old('alamat_domisili', $petanis->alamat_domisili ?? '-') }}</textarea>
                            @error('alamat_domisili')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Alamat Kebun</label>
                            <textarea name="alamat_kebun" class="form-control @error('alamat_kebun') is-invalid @enderror" rows="5"
                                placeholder="Masukan alamat kebun">{{ old('alamat_kebun', $petanis->alamat_kebun ?? '-') }}</textarea>
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
