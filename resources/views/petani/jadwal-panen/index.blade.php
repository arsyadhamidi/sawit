@extends('admin.layout.master')
@section('menuPetaniJadwalPanen', 'active')
@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Jadwal Panen</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('petani-jadwalpanen.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Jadwal Panen
            </a>
        </div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-lg">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 4%; text-align:center">No.</th>
                                <th style="text-align:center">Petani</th>
                                <th style="text-align:center">Waktu</th>
                                <th style="text-align:center">Luas</th>
                                <th style="text-align:center">Lokasi</th>
                                <th style="text-align:center">Lat/Long</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->petani->nama ?? '-' }}</td>
                                    <td>{{ $data->waktu_panen ?? '-' }}</td>
                                    <td>{{ $data->luas_kebun ?? '-' }}</td>
                                    <td>{{ $data->lokasi_kebun ?? '-' }}</td>
                                    <td>{{ $data->latitude ?? '-' }}, {{ $data->latitude ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('petani-jadwalpanen.destroy', $data->id) }}" method="POST"
                                            class="d-flex">
                                            @csrf
                                            <a href="{{ route('petani-jadwalpanen.edit', $data->id) }}"
                                                class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('petani-jadwalpanen.show', $data->id) }}"
                                                class="btn btn-sm btn-outline-warning mx-2">
                                                <i class="fas fa-map-pin"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" id="hapusData">
                                                <i class="fas fa-trash-alt"></i>
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
        $(document).on('click', '#hapusData', function(event) {
            event.preventDefault(); // Mencegah perilaku default tombol

            // Ambil URL aksi penghapusan dari atribut 'action' formulir
            var deleteUrl = $(this).closest('form').attr('action');

            // Tampilkan SweetAlert saat tombol di klik
            Swal.fire({
                icon: 'question',
                title: 'Hapus Jadwal Panen ?',
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
