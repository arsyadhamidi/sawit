<div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Biodata Petani</h5>
    </div>
</div>

<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                @php
                    $petanis = \App\Models\Petani::where('users_id', Auth()->user()->id)->first();
                @endphp
                @if (!empty($petanis))
                    <a href="{{ route('edit-biodatapetani.edit', $petanis->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Edit Biodata Diri
                    </a>
                @else
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Isi Biodata Diri
                    </a>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td width="30%">Nama Lengkap</td>
                        <td width="3%">:</td>
                        <td>{{ $petanis->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Nomor Telepon</td>
                        <td width="3%">:</td>
                        <td>{{ $petanis->telp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Alamat Domisli</td>
                        <td width="3%">:</td>
                        <td>{{ $petanis->alamat_domisili ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Alamat Kebun</td>
                        <td width="3%">:</td>
                        <td>{{ $petanis->alamat_kebun ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Username</td>
                        <td width="3%">:</td>
                        <td>{{ $petanis->users->username ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Status</td>
                        <td width="3%">:</td>
                        <td>{{ $petanis->users->level->namalevel ?? '-' }}</td>
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
