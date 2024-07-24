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
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('petani-jadwalpanen.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const latitude = {{ $jadwals->latitude }};
            const longitude = {{ $jadwals->longitude }};

            const map = L.map('map').setView([latitude, longitude], 13);

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            const marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('<b>Hello!</b><br />Disini lokasi kebun saya.').openPopup();

            const popup = L.popup();

            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent(`You clicked the map at ${e.latlng.toString()}`)
                    .openOn(map);
            }

            map.on('click', onMapClick);
        });
    </script>
@endpush
