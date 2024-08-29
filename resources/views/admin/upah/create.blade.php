@extends('admin.layout.master')
@section('menuDataMaster', 'active')
@section('menuDataUpah', 'active')

@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Gaji Pekerja</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-upah.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-upah.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Simpan Data
                        </button>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <select name="bulan" id="bulan" class="form-control">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Pilih Tahun:</label>
                            <input type="number" name="tahun" id="tahun" value="{{ \Carbon\Carbon::now()->year }}"
                                class="form-control">
                        </div>
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th style="width: 4%; text-align:center">
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                    <th style="text-align:center">Petani</th>
                                    <th style="text-align:center">Supir</th>
                                    <th style="text-align:center">Pemuat</th>
                                    <th style="text-align:center">Tanggal</th>
                                    <th style="text-align:center">Q TBS</th>
                                    <th style="text-align:center">Harga TBS</th>
                                    <th style="text-align:center">Q Berondolan</th>
                                    <th style="text-align:center">Harga Berondolan</th>
                                    <th style="text-align:center">Total</th>
                                    <th style="text-align:center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembelians as $data)
                                    <tr>
                                        <td style="text-align: center">
                                            <input type="checkbox" name="pengembalian_ids[]" class="checkItem">
                                        </td>
                                        <td>{{ $data->petani->nama ?? '-' }}</td>
                                        <td>{{ $data->supir->nama ?? '-' }}</td>
                                        <td>{{ $data->pemuat->nama ?? '-' }}</td>
                                        <td>{{ $data->tanggal ?? '-' }}</td>
                                        <td>{{ $data->quantity_tbs ?? '-' }}</td>
                                        <td>Rp. {{ $data->total_tbs ?? '0' }},-</td>
                                        <td>{{ $data->quantity_berondolan ?? '-' }}</td>
                                        <td>Rp. {{ $data->total_berondolan ?? '0' }},-</td>
                                        <td>Rp. {{ $data->total_pembelian ?? '0' }},-</td>
                                        <td>
                                            <form action="{{ route('data-pembelian.destroy', $data->id) }}" method="POST"
                                                class="d-flex">
                                                @csrf
                                                <a href="{{ route('data-pembelian.edit', $data->id) }}"
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
            </form>
        </div>
    </div>
@endsection
@push('custom-script')
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.checkItem');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endpush
