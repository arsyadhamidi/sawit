@extends('admin.layout.master')
@section('menuDataPinjamans', 'active')
@section('menuPinjamanProses', 'active')

@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Peminjaman Proses</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <h4 class="card-title">Pinjaman dalam tahap proses</h4>
            <div class="row">
                <div class="col-lg">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 4%; text-align:center">No.</th>
                                <th style="text-align:center">Nomor</th>
                                <th style="text-align:center">Pekerja</th>
                                <th style="text-align:center">Tanggal Awal</th>
                                <th style="text-align:center">Tanggal Akhir</th>
                                <th style="text-align:center">Nominal</th>
                                <th style="text-align:center">Alasan</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nomor_peminjaman ?? '-' }}</td>
                                    <td>{{ $data->users->name ?? '-' }}</td>
                                    <td>{{ $data->tgl_awal ?? '-' }}</td>
                                    <td>{{ $data->tgl_akhir ?? '-' }}</td>
                                    <td>Rp. {{ $data->nominal ?? '0' }},-</td>
                                    <td>{{ $data->alasan ?? '-' }}</td>
                                    <td>
                                        @if ($data->status == 'Diterima')
                                            <span class="badge badge-success">{{ $data->status ?? '-' }}</span>
                                        @elseif($data->status == 'Ditolak')
                                            <span class="badge badge-danger">{{ $data->status ?? '-' }}</span>
                                        @elseif($data->status == 'Proses')
                                            <span class="badge badge-warning">{{ $data->status ?? '-' }}</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak Tersedia</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <form action="{{ route('data-peminjaman.disetujui', $data->id) }}" method="POST"
                                            class="d-flex">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success mx-2" id="disetujuiData">
                                                <i class="fas fa-check"></i>
                                                Disetujui
                                            </button>
                                        </form>
                                        <form action="{{ route('data-peminjaman.ditolak', $data->id) }}" method="POST"
                                            class="d-flex">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger mx-2" id="ditolakData">
                                                <i class="fas fa-times"></i>
                                                Ditolak
                                            </button>
                                        </form>
                                    </td>
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
        $(document).on('click', '#disetujuiData', function(event) {
            event.preventDefault(); // Mencegah perilaku default tombol

            // Ambil URL aksi penghapusan dari atribut 'action' formulir
            var deleteUrl = $(this).closest('form').attr('action');

            // Tampilkan SweetAlert saat tombol di klik
            Swal.fire({
                icon: 'question',
                title: 'Pinjaman Ini Disetujui ?',
                text: 'Apakah anda yakin untuk menyetujui pinjaman ini?',
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
                                title: 'Berhasil',
                                text: 'Data Berhasil Diterima.',
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
    <script>
        // Mendengarkan acara klik tombol hapus
        $(document).on('click', '#ditolakData', function(event) {
            event.preventDefault(); // Mencegah perilaku default tombol

            // Ambil URL aksi penghapusan dari atribut 'action' formulir
            var deleteUrl = $(this).closest('form').attr('action');

            // Tampilkan SweetAlert saat tombol di klik
            Swal.fire({
                icon: 'question',
                title: 'Pinjaman Ini Ditolak ?',
                text: 'Apakah anda yakin untuk menolak pinjaman ini?',
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
                                title: 'Berhasil',
                                text: 'Data Berhasil Ditolak',
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
