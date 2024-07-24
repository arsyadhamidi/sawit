@extends('admin.layout.master')
@section('menuPemilikTransaksi', 'active')
@section('menuPemilikPenjualan', 'active')

@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Penjualan</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            List Data Penjualan
        </div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-lg">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 4%; text-align:center">No.</th>
                                <th style="text-align:center">Supir</th>
                                <th style="text-align:center">Tanggal</th>
                                <th style="text-align:center">Q TBS</th>
                                <th style="text-align:center">Harga TBS</th>
                                <th style="text-align:center">Q Berondolan</th>
                                <th style="text-align:center">Harga Berondolan</th>
                                <th style="text-align:center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualans as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->supir->nama ?? '-' }}</td>
                                    <td>{{ $data->tanggal ?? '-' }}</td>
                                    <td>{{ $data->quantity_tbs ?? '-' }}</td>
                                    <td>Rp. {{ $data->total_tbs ?? '0' }},-</td>
                                    <td>{{ $data->quantity_berondolan ?? '-' }}</td>
                                    <td>Rp. {{ $data->total_berondolan ?? '0' }},-</td>
                                    <td>Rp. {{ $data->total_penjualan ?? '0' }},-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
        });
    </script>
    <script>
        // Mendengarkan acara klik tombol hapus
        $(document).on('click', '#hapusData', function(event) {
            event.preventDefault(); // Mencegah perilaku default tombol

            // Ambil URL aksi penghapusan dari atribut 'action' formulir
            var deleteUrl = $(this).closest('form').attr('action');

            // Tampilkan SweetAlert saat tombol di klik
            Swal.fire({
                icon: 'question',
                title: 'Hapus Data Penjualan ?',
                text: 'Apakah anda yakin untuk menghapus data ini?',
                showCancelButton: true, // Tampilkan tombol batal
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745', // Warna hijau untuk tombol konfirmasi
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#dc3545' // Warna merah untuk tombol pembatalan
            }).then((result) => {
                // Lanjutkan jika pengguna mengkonfirmasi penghapusan
                if (result.isConfirmed) {
                    // Kirim permintaan AJAX DELETE ke URL penghapusan
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}" // Kirim token CSRF untuk keamanan
                        },
                        success: function(response) {
                            // Tampilkan pesan sukses jika penghapusan berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Data successfully deleted.',
                                showConfirmButton: false,
                                timer: 1500 // Durasi pesan success (dalam milidetik)
                            });

                            // Refresh halaman setelah pesan sukses ditampilkan
                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            // Tampilkan pesan error jika penghapusan gagal
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat menghapus data.',
                                showConfirmButton: false,
                                timer: 1500 // Durasi pesan error (dalam milidetik)
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
