@extends('admin.layout.master')
@section('menuDataAutentikasi', 'active')
@section('menuDataStatusAutentikasi', 'active')
@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Status Autentikasi</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-level.update', $levels->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-level.index') }}" class="btn btn-primary">
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
                            <label>ID Status</label>
                            <input type="number" name="id_level"
                                class="form-control @error('id_level') is-invalid @enderror"
                                value="{{ old('id_level', $levels->id_level ?? '-') }}" placeholder="Masukan ID Status">
                            @error('id_level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Nama Status</label>
                            <input type="text" name="namalevel"
                                class="form-control @error('namalevel') is-invalid @enderror"
                                value="{{ old('namalevel', $levels->namalevel ?? '-') }}" placeholder="Masukan Nama Status">
                            @error('namalevel')
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
