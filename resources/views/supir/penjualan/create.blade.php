@extends('admin.layout.master')
@section('menuSupirTransaksi', 'active')
@section('menuSupirPenjualan', 'active')

@section('content')
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="text-titlecase">Data Penjualan</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('supir-penjualan.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('supir-penjualan.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Simpan Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal"
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Quantity TBS</label>
                                    <input type="number" name="quantity_tbs"
                                        class="form-control @error('quantity_tbs') is-invalid @enderror"
                                        value="{{ old('quantity_tbs') }}" placeholder="Masukan Quantity" id="quantityTbs">
                                    @error('quantity_tbs')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Total Harga TBS</label>
                                    <input type="number" name="total_tbs"
                                        class="form-control @error('total_tbs') is-invalid @enderror"
                                        value="{{ old('total_tbs') }}" placeholder="Masukan Total Harga TBS" readonly
                                        id="totalTbs">
                                    @error('total_tbs')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Quantity Berondolan</label>
                                    <input type="number" name="quantity_berondolan"
                                        class="form-control @error('quantity_berondolan') is-invalid @enderror"
                                        value="{{ old('quantity_berondolan') }}" placeholder="Masukan Quantity"
                                        id="quantityBerondolan">
                                    @error('quantity_berondolan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Total Harga Berondolan</label>
                                    <input type="number" name="total_berondolan"
                                        class="form-control @error('total_berondolan') is-invalid @enderror"
                                        value="{{ old('total_berondolan') }}" placeholder="Masukan Total Harga Berondolan"
                                        readonly id="totalBerondolan">
                                    @error('total_berondolan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Total Penjualan</label>
                                    <input type="number" name="total_penjualan"
                                        class="form-control @error('total_penjualan') is-invalid @enderror"
                                        value="{{ old('total_penjualan') }}" placeholder="Masukan Total Pembelian" readonly
                                        id="totalPembelian">
                                    @error('total_penjualan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
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
            var hargaTbs = {{ $hargas->harga_tbs ?? 0 }}; // Harga TBS terbaru dari controller
            var hargaBerondolan = {{ $hargas->harga_berondolan ?? 0 }}; // Harga berondolan terbaru dari controller

            function updateTotalPembelian() {
                var totalTbs = parseFloat($('#totalTbs').val()) || 0;
                var totalBerondolan = parseFloat($('#totalBerondolan').val()) || 0;
                var totalPembelian = totalTbs + totalBerondolan;
                $('#totalPembelian').val(totalPembelian);
            }

            $('#quantityTbs').on('input', function() {
                var quantity = $(this).val();
                var total = quantity * hargaTbs;
                $('#totalTbs').val(total);
                updateTotalPembelian();
            });

            $('#quantityBerondolan').on('input', function() {
                var quantityBerondolan = $(this).val();
                var totalBerondolan = quantityBerondolan * hargaBerondolan;
                $('#totalBerondolan').val(totalBerondolan);
                updateTotalPembelian();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#selectedSupir').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
