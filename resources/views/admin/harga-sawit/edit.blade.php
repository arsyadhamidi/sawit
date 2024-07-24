@extends('admin.layout.master')
@section('menuDataMaster', 'active')
@section('menuDataHargaSawit', 'active')
@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Harga Sawit</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-hargasawit.update', $hargas->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-hargasawit.index') }}" class="btn btn-primary">
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
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', $hargas->tanggal) }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Harga TBS</label>
                            <input type="number" name="harga_tbs"
                                class="form-control @error('harga_tbs') is-invalid @enderror"
                                value="{{ old('harga_tbs', $hargas->harga_tbs ?? '-') }}" placeholder="Masukan Harga TBS">
                            @error('harga_tbs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Harga Berondolan</label>
                            <input type="number" name="harga_berondolan"
                                class="form-control @error('harga_berondolan') is-invalid @enderror"
                                value="{{ old('harga_berondolan', $hargas->harga_berondolan ?? '-') }}"
                                placeholder="Masukan Harga Berondolan">
                            @error('harga_berondolan')
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
