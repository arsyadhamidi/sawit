@extends('admin.layout.master')
@section('menuDataTransaksi', 'active')
@section('menuDataPeminjaman', 'active')

@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Peminjaman</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-peminjaman.update', $peminjamans->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-peminjaman.index') }}" class="btn btn-primary">
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
                                style="width: 100%" id="selectedPekerja">
                                <option value="" selected>Pilih Users Registrasi</option>
                                @foreach ($users as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $peminjamans->users_id == $data->id ? 'selected' : '' }}>{{ $data->name ?? '-' }}
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
                            <label>Tanggal Awal Peminjaman</label>
                            <input type="date" name="tgl_awal"
                                class="form-control @error('tgl_awal') is-invalid @enderror"
                                value="{{ old('tgl_awal', $peminjamans->tgl_awal) }}">
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
                                value="{{ old('tgl_akhir', $peminjamans->tgl_akhir) }}">
                            @error('tgl_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Nominal Peminjaman</label>
                            <input type="number" name="nominal" class="form-control @error('nominal') is-invalid @enderror"
                                value="{{ old('nominal', $peminjamans->nominal ?? '-') }}"
                                placeholder="Masukan Nominal Peminjaman">
                            @error('nominal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Alasan</label>
                            <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="5"
                                placeholder="Masukan Alasan Peminjaman">{{ old('alasan', $peminjamans->alasan ?? '-') }}</textarea>
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
            $('#selectedStatus').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
