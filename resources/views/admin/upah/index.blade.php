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
            <div class="card">
                <div class="card-body table-responsive">
                    <h4 class="card-title">List Data Pekerja</h4>
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 4%">No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Telepon</th>
                                <th>SIM</th>
                                <th>Aksi</th>
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
                                    <td>
                                        <a href="#" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                            Gaji Pekerja
                                        </a>
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
