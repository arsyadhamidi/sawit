<div class="row mb-4">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Users Registrasi</p>
                        <h1 class="mb-0">{{ $users ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Status Autentikasi</p>
                        <h1 class="mb-0">{{ $levels ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Petani</p>
                        <h1 class="mb-0">{{ $petanis ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Pekerja</p>
                        <h1 class="mb-0">{{ $pekerjas ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Jadwal Panen</p>
                        <h1 class="mb-0">{{ $jadwals ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Harga Sawit</p>
                        <h1 class="mb-0">{{ $hargas ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Data Pembelian</p>
                        <h1 class="mb-0">{{ $pembelians ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Data Penjualan</p>
                        <h1 class="mb-0">{{ $penjualans ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                        <p class="mb-2 text-md-center text-lg-left">Data Peminjamans</p>
                        <h1 class="mb-0">{{ $peminjamans ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Diagram Pembelian</h4>
                <div>
                    <canvas id="pembelianChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Diagram Penjualan</h4>
                <div>
                    <canvas id="penjualanChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-script')
    <script>
        const pembelianCtx = document.getElementById('pembelianChart').getContext('2d');
        const pembelianData = @json(array_values($pembelianPerBulan));
        const bulanLabels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember'
        ];

        new Chart(pembelianCtx, {
            type: 'bar',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Jumlah Pembelian',
                    data: pembelianData,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const penjualanCtx = document.getElementById('penjualanChart').getContext('2d');
        const penjualanData = @json(array_values($penjualanPerBulan));

        new Chart(penjualanCtx, {
            type: 'bar',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Jumlah Penjualan',
                    data: penjualanData,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
