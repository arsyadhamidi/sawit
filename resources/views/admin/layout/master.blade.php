<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | UD Sawit Dongan</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- base:js -->
    <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #myTable td,
        #myTable th {
            line-height: 1.8;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="/dashboard"><img src="{{ asset('admin/images/logo.svg') }}"
                            alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img
                            src="{{ asset('admin/images/logo-mini.svg') }}" alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="typcn typcn-th-menu"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                            @if (Auth()->user()->foto_profile)
                                <img src="{{ asset('storage/' . Auth()->user()->foto_profile) }}" alt="profile" />
                            @else
                                <img src="{{ asset('images/foto-profile.png') }}" alt="profile" />
                            @endif
                            <span class="nav-profile-name">{{ Auth()->user()->name ?? '-' }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('setting.index') }}">
                                <i class="typcn typcn-cog-outline text-primary"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('login.logout') }}">
                                <i class="typcn typcn-eject text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-date dropdown">
                        <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
                            <h6 class="date mb-0">{{ \Carbon\Carbon::now()->format('j F Y') }}</h6>
                            <i class="typcn typcn-calendar"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close typcn typcn-times"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close typcn typcn-times"></i>
                <ul class="nav nav-tabs" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section"
                            role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                            aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                        aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input"
                                        placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        id="add-task">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Team review meeting at 3.00 PM
                                        </label>
                                    </div>
                                    <i class="remove typcn typcn-delete-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Prepare for presentation
                                        </label>
                                    </div>
                                    <i class="remove typcn typcn-delete-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Resolve all the low priority tickets due today
                                        </label>
                                    </div>
                                    <i class="remove typcn typcn-delete-outline"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Schedule meeting for next week
                                        </label>
                                    </div>
                                    <i class="remove typcn typcn-delete-outline"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Project review
                                        </label>
                                    </div>
                                    <i class="remove typcn typcn-delete-outline"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="events py-4 border-bottom px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="typcn typcn-media-record-outline text-primary mr-2"></i>
                                <span>Feb 11 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                            <p class="text-gray mb-0">build a js based app</p>
                        </div>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="typcn typcn-media-record-outline text-primary mr-2"></i>
                                <span>Feb 7 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                            <p class="text-gray mb-0 ">Call Sarah Graves</p>
                        </div>
                    </div>
                    <!-- To do section tab ends -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small
                                class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                                All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span
                                        class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span
                                        class="offline"></span></div>
                                <div class="info">
                                    <div class="wrapper d-flex">
                                        <p>Catherine</p>
                                    </div>
                                    <p>Away</p>
                                </div>
                                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                <small class="text-muted my-auto">23 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span
                                        class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span
                                        class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span
                                        class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span
                                        class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>
                    <!-- chat tab ends -->
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link @yield('menuDashboard')" href="/dashboard">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                            {{-- <div class="badge badge-danger">new</div> --}}
                        </a>
                    </li>
                    @if (Auth()->user()->level_id == '1')
                        <li class="nav-item">
                            <a class="nav-link @yield('menuDataMaster')" data-toggle="collapse" href="#data-master"
                                aria-expanded="false" aria-controls="data-master">
                                <i class="typcn typcn-folder menu-icon"></i>
                                <span class="menu-title">Data Master</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="data-master">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataPekerja')"
                                            href="{{ route('data-pekerja.index') }}">Data
                                            Pekerja</a></li>
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataPetani')"
                                            href="{{ route('data-petani.index') }}">Data
                                            Petani</a></li>
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataJadwalPanen')"
                                            href="{{ route('data-jadwalpanen.index') }}">Jadwal Panen</a></li>
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataHargaSawit')"
                                            href="{{ route('data-hargasawit.index') }}">Harga Sawit</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuDataTransaksi')" data-toggle="collapse" href="#data-transaksi"
                                aria-expanded="false" aria-controls="data-transaksi">
                                <i class="typcn typcn-book menu-icon"></i>
                                <span class="menu-title">Data Transaksi</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="data-transaksi">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataPembelian')"
                                            href="{{ route('data-pembelian.index') }}">Data
                                            Pembelian</a></li>
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataPenjualan')"
                                            href="{{ route('data-penjualan.index') }}">Data
                                            Penjualan</a></li>
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataPeminjaman')"
                                            href="{{ route('data-peminjaman.index') }}">Data
                                            Peminjaman</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuDataAutentikasi')" data-toggle="collapse" href="#ui-basic"
                                aria-expanded="false" aria-controls="ui-basic">
                                <i class="typcn typcn-user menu-icon"></i>
                                <span class="menu-title">Data Autentikasi</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataStatusAutentikasi')"
                                            href="{{ route('data-level.index') }}">Status
                                            Autentikasi</a></li>
                                    <li class="nav-item"> <a class="nav-link @yield('menuDataUsersRegistrasi')"
                                            href="{{ route('data-user.index') }}">Users
                                            Registrasi</a></li>
                                </ul>
                            </div>
                        </li>
                    @elseif(Auth()->user()->level_id == '2')
                        <li class="nav-item">
                            <a class="nav-link @yield('menuPetaniJadwalPanen')" href="{{ route('petani-jadwalpanen.index') }}">
                                <i class="typcn typcn-calendar-outline menu-icon"></i>
                                <span class="menu-title">Jadwal Panen</span>
                                {{-- <div class="badge badge-danger">new</div> --}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuPetaniHargaSawit')" href="{{ route('petani-hargasawit.index') }}">
                                <i class="typcn typcn-ticket menu-icon"></i>
                                <span class="menu-title">Harga Sawit</span>
                                {{-- <div class="badge badge-danger">new</div> --}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuPetaniPeminjaman')" href="{{ route('petani-peminjaman.index') }}">
                                <i class="typcn typcn-book menu-icon"></i>
                                <span class="menu-title">Peminjaman</span>
                                {{-- <div class="badge badge-danger">new</div> --}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuPetaniPembelian')" href="{{ route('petani-pembelian.index') }}">
                                <i class="typcn typcn-chart-bar-outline menu-icon"></i>
                                <span class="menu-title">Laporan Pembelian</span>
                                {{-- <div class="badge badge-danger">new</div> --}}
                            </a>
                        </li>
                    @elseif(Auth()->user()->level_id == '3')
                        <li class="nav-item">
                            <a class="nav-link @yield('menuSupirTransaksi')" data-toggle="collapse" href="#data-transaksi"
                                aria-expanded="false" aria-controls="data-transaksi">
                                <i class="typcn typcn-book menu-icon"></i>
                                <span class="menu-title">Data Transaksi</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="data-transaksi">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link @yield('menuSupirPembelian')"
                                            href="{{ route('supir-pembelian.index') }}">Data
                                            Pembelian</a></li>
                                    <li class="nav-item"> <a class="nav-link @yield('menuSupirPenjualan')"
                                            href="{{ route('supir-penjualan.index') }}">Data
                                            Penjualan</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('menuSupirPeminjaman')" href="{{ route('supir-peminjaman.index') }}">
                                <i class="typcn typcn-folder menu-icon"></i>
                                <span class="menu-title">Peminjaman</span>
                                {{-- <div class="badge badge-danger">new</div> --}}
                            </a>
                        </li>
                    @elseif(Auth()->user()->level_id == '5')
                        <li class="nav-item">
                            <a class="nav-link @yield('menuPemilikTransaksi')" data-toggle="collapse" href="#data-transaksi"
                                aria-expanded="false" aria-controls="data-transaksi">
                                <i class="typcn typcn-book menu-icon"></i>
                                <span class="menu-title">Data Transaksi</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="data-transaksi">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link @yield('menuPemilikPembelian')"
                                            href="{{ route('pemilik-pembelian.index') }}">Data
                                            Pembelian</a></li>
                                    <li class="nav-item"> <a class="nav-link @yield('menuPemilikPenjualan')"
                                            href="{{ route('pemilik-penjualan.index') }}">Data
                                            Penjualan</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link @yield('menuSetting')" href="{{ route('setting.index') }}">
                            <i class="typcn typcn-cog menu-icon"></i>
                            <span class="menu-title">Pengaturan</span>
                            {{-- <div class="badge badge-danger">new</div> --}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.logout') }}">
                            <i class="typcn typcn-eject menu-icon"></i>
                            <span class="menu-title">Logout</span>
                            {{-- <div class="badge badge-danger">new</div> --}}
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('content')

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                                    2020 <a href="https://www.bootstrapdash.com/" class="text-muted"
                                        target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                                <span
                                    class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Free
                                    <a href="https://www.bootstrapdash.com/" class="text-muted"
                                        target="_blank">Bootstrap dashboard</a> templates from Bootstrapdash.com</span>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/js/settings.js') }}"></script>
    <script src="{{ asset('admin/js/todolist.js') }}"></script>
    <script src="{{ asset('admin/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ asset('admin/js/file-upload.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    @stack('custom-script')
    <!-- End custom js for this page-->
</body>

</html>
