@extends('admin.layout.master')
@section('menuPetaniPeminjaman', 'active')

@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Peminjaman</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('petani-peminjaman.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('petani-peminjaman.index') }}" class="btn btn-primary">
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
                            <label>Tanggal Awal Peminjaman</label>
                            <input type="date" name="tgl_awal"
                                class="form-control @error('tgl_awal') is-invalid @enderror"
                                value="{{ old('tgl_awal', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                            @error('tgl_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Berakhir Peminjaman</label>
                            <input type="date" name="tgl_akhir"
                                class="form-control @error('tgl_akhir') is-invalid @enderror"
                                value="{{ old('tgl_akhir', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                            @error('tgl_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Nominal Peminjaman</label>
                            <input type="number" name="nominal" class="form-control @error('nominal') is-invalid @enderror"
                                value="{{ old('nominal') }}" placeholder="Masukan Nominal Peminjaman">
                            @error('nominal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Alasan</label>
                            <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="5"
                                placeholder="Masukan Alasan Peminjaman">{{ old('alasan') }}</textarea>
                            @error('alasan')
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
            $('#selectedPekerja').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
