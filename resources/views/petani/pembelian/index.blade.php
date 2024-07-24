@extends('admin.layout.master')
@section('menuPetaniPembelian', 'active')

@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Pembelian</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            List Laporan Pembelian
        </div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-lg">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 4%; text-align:center">No.</th>
                                <th style="text-align:center">Petani</th>
                                <th style="text-align:center">Supir</th>
                                <th style="text-align:center">Pemuat</th>
                                <th style="text-align:center">Tanggal</th>
                                <th style="text-align:center">Q TBS</th>
                                <th style="text-align:center">Harga TBS</th>
                                <th style="text-align:center">Q Berondolan</th>
                                <th style="text-align:center">Harga Berondolan</th>
                                <th style="text-align:center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembelians as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->petani->nama ?? '-' }}</td>
                                    <td>{{ $data->supir->nama ?? '-' }}</td>
                                    <td>{{ $data->pemuat->nama ?? '-' }}</td>
                                    <td>{{ $data->tanggal ?? '-' }}</td>
                                    <td>{{ $data->quantity_tbs ?? '-' }}</td>
                                    <td>Rp. {{ $data->total_tbs ?? '0' }},-</td>
                                    <td>{{ $data->quantity_berondolan ?? '-' }}</td>
                                    <td>Rp. {{ $data->total_berondolan ?? '0' }},-</td>
                                    <td>Rp. {{ $data->total_pembelian ?? '0' }},-</td>
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
@endpush
