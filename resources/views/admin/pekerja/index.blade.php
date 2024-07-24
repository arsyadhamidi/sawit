@extends('admin.layout.master')
@section('menuDataMaster', 'active')
@section('menuDataPekerja', 'active')
@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Pekerja</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('data-pekerja.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Data Pekerja
            </a>
        </div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-lg">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 4%; text-align:center">No.</th>
                                <th style="text-align:center">NIK</th>
                                <th style="text-align:center">Nama</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Telepon</th>
                                <th style="text-align:center">SIM</th>
                                <th style="text-align:center">Alamat</th>
                                <th style="text-align:center">Gaji</th>
                                <th style="text-align:center">Foto</th>
                                <th style="text-align:center">Gaji Pekerja</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pekerjas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nik ?? '-' }}</td>
                                    <td>{{ $data->nama ?? '-' }}</td>
                                    <td>{{ $data->level->namalevel ?? '-' }}</td>
                                    <td>{{ $data->telp ?? '-' }}</td>
                                    <td>{{ $data->sim ?? '-' }}</td>
                                    <td>{{ $data->alamat ?? '-' }}</td>
                                    <td>Rp. {{ $data->gaji->gaji_pekerja ?? '-' }},-</td>
                                    <td>
                                        @if (!empty($data->foto_pekerja))
                                            <img src="{{ asset('storage/' . $data->foto_pekerja) }}" class="img-fluid"
                                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 20px;"
                                                alt="">
                                        @else
                                            <img src="{{ asset('images/foto-profile.png') }}" class="img-fluid"
                                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 20px;"
                                                alt="">
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $gajis = \App\Models\Gaji::where('pekerja_id', $data->id)->first();
                                        @endphp
                                        @if (!empty($gajis))
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#updateGajiModal{{ $data->id }}">
                                                <i class="fas fa-user-edit"></i>
                                                Edit Gaji Pekerja
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $data->id }}">
                                                <i class="fas fa-user-plus"></i>
                                                Gaji Pekerja
                                            </button>
                                        @endif

                                        <!-- Tambah Gaji -->
                                        <form action="{{ route('data-gajipekerja.store') }}" method="POST">
                                            @csrf
                                            <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Masukan Gaji
                                                                Pekerja
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{-- ID Pekerja --}}
                                                            <input type="number" name="pekerja_id" class="form-control"
                                                                value="{{ $data->id }}" hidden>
                                                            <input type="text" name="gaji_pekerja"
                                                                class="form-control @error('gaji_pekerja') is-invalid @enderror"
                                                                value="{{ old('gaji_pekerja') }}"
                                                                placeholder="Masukan gaji pekerja">
                                                            @error('gaji_pekerja')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">
                                                                <i class="fas fa-times"></i>
                                                                Kembali
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-save"></i>
                                                                Simpan Data
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- Edit Gaji -->
                                        <form action="{{ route('data-gajipekerja.update') }}" method="POST">
                                            @csrf
                                            <div class="modal fade" id="updateGajiModal{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Gaji
                                                                Pekerja
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{-- ID --}}
                                                            <input type="number" name="id" class="form-control"
                                                                value="{{ $data->gaji->id ?? '0' }}" hidden>
                                                            {{-- ID Pekerja --}}
                                                            <input type="number" name="pekerja_id" class="form-control"
                                                                value="{{ $data->id }}" hidden>
                                                            <input type="text" name="gaji_pekerja"
                                                                class="form-control @error('gaji_pekerja') is-invalid @enderror"
                                                                value="{{ old('gaji_pekerja', $data->gaji->gaji_pekerja ?? '0') }}"
                                                                placeholder="Masukan gaji pekerja">
                                                            @error('gaji_pekerja')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">
                                                                <i class="fas fa-times"></i>
                                                                Kembali
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-save"></i>
                                                                Simpan Data
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('data-pekerja.destroy', $data->id) }}" method="POST"
                                            class="d-flex">
                                            @csrf
                                            <a href="{{ route('data-pekerja.edit', $data->id) }}"
                                                class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-outline-danger mx-2"
                                                id="hapusData">
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
                title: 'Hapus Data Pekerja ?',
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
