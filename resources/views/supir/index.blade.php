<div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Biodata Pekerja</h5>
    </div>
</div>

<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                @php
                    $pekerjas = \App\Models\Pekerja::where('id', Auth()->user()->pekerja_id)->first();
                @endphp
                {{-- @if (!empty($pekerjas))
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Edit Biodata Diri
                    </a>
                @endif --}}
                Data - Data
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td width="30%">No. KTP</td>
                        <td width="3%">:</td>
                        <td>{{ $pekerjas->nik ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Nama Lengkap</td>
                        <td width="3%">:</td>
                        <td>{{ $pekerjas->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Nomor Telepon</td>
                        <td width="3%">:</td>
                        <td>{{ $pekerjas->telp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">SIM</td>
                        <td width="3%">:</td>
                        <td>{{ $pekerjas->sim ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Alamat Domisili</td>
                        <td width="3%">:</td>
                        <td>{{ $pekerjas->alamat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Username</td>
                        <td width="3%">:</td>
                        <td>{{ $pekerjas->users->username ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Status</td>
                        <td width="3%">:</td>
                        <td>{{ $pekerjas->users->level->namalevel ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
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
