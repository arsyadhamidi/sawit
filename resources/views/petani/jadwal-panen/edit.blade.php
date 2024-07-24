@extends('admin.layout.master')
@section('menuPetaniJadwalPanen', 'active')
@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Jadwal Panen</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('petani-jadwalpanen.update', $jadwals->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('petani-jadwalpanen.index') }}" class="btn btn-primary">
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
                            <label>Pilih Waktu Panen</label>
                            <select name="waktu_panen" class="form-control @error('waktu_panen') is-invalid @enderror"
                                style="width: 100%" id="selectedWaktuPanen">
                                <option value="" selected>Waktu Panen</option>
                                <option value="Per 1 minggu"
                                    {{ $jadwals->waktu_panen == 'Per 1 minggu' ? 'selected' : '' }}>Per 1 minggu</option>
                                <option value="Per 2 minggu"
                                    {{ $jadwals->waktu_panen == 'Per 2 minggu' ? 'selected' : '' }}>Per 2 minggu</option>
                                <option value="Per 3 minggu"
                                    {{ $jadwals->waktu_panen == 'Per 3 minggu' ? 'selected' : '' }}>Per 3 minggu</option>
                                <option value="Per 4 minggu"
                                    {{ $jadwals->waktu_panen == 'Per 4 minggu' ? 'selected' : '' }}>Per 4 minggu</option>
                            </select>
                            @error('waktu_panen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Luas Kebun</label>
                            <input type="text" name="luas_kebun"
                                class="form-control @error('luas_kebun') is-invalid @enderror"
                                value="{{ old('luas_kebun', $jadwals->luas_kebun ?? '-') }}"
                                placeholder="Masukan Luas Kebun">
                            @error('luas_kebun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Lokasi Kebun</label>
                            <input type="text" name="lokasi_kebun"
                                class="form-control @error('lokasi_kebun') is-invalid @enderror"
                                value="{{ old('lokasi_kebun', $jadwals->lokasi_kebun ?? '-') }}"
                                placeholder="Masukan Lokasi Kebun">
                            @error('lokasi_kebun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Latitude</label>
                            <input type="text" name="latitude"
                                class="form-control @error('latitude') is-invalid @enderror"
                                value="{{ old('latitude', $jadwals->latitude ?? '-') }}" placeholder="Masukan Latitude">
                            @error('latitude')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Longitude</label>
                            <input type="text" name="longitude"
                                class="form-control @error('longitude') is-invalid @enderror"
                                value="{{ old('longitude', $jadwals->longitude ?? '-') }}" placeholder="Masukan Longitude">
                            @error('longitude')
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
            $('#selectedPetani').select2({
                theme: 'bootstrap4',
            });
            $('#selectedWaktuPanen').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
