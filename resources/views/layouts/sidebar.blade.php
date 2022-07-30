<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- <!-- Brand Logo --> --}}
    <a class="brand-link text-white">
        <img src="{{ asset('assets/img/jatim.png') }}" alt="Diskominfo Jatim" class="brand-image" style="float: none; margin-left: 1rem; margin-right: 1rem;">
        <span class="brand-text font-weight-light">Hoster</span>
    </a>

    {{-- <!-- Sidebar --> --}}
    <div class="sidebar">
        {{-- <!-- Sidebar user (optional) --> --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-circle elevation-2" style="opacity: .8">
            </div>
            <div class="info">
                <a href="/profile" class="d-block">{{ Auth::user()->nama }}</a>
            </div>
        </div>

        {{-- <!-- SidebarSearch Form --> --}}
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        {{-- <!-- Sidebar Menu --> --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->id_role == 1)
                    {{-- <!-- View User Pimpinan --> --}}
                    <li class="nav-item">
                        <a href="{{ route('pimpinan') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pimpinan.permohonan') }}" class="nav-link">
                            <i class="fas fa-book-open nav-icon"></i>
                            <p>Permohonan</p>
                        </a>
                    </li>

                @elseif (Auth::user()->id_role == 2)
                    <!-- View User Teknisi -->
                    <li class="nav-item">
                        <a href="{{ route('teknisi') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teknisi.permohonan') }}" class="nav-link">
                            <i class="fas fa-book-open nav-icon"></i>
                            <p>Permohonan</p>
                        </a>
                    </li>

                @elseif (Auth::user()->id_role == 3)
                    {{-- <!-- View Administrator --> --}}
                    <li class="nav-item">
                        <a href="/admin" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="fas fa-user-friends nav-icon"></i>
                            <p>User</p>
                            <i class="fas fa-angle-left right"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/employee" class="nav-link">
                                    <p>Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/user/pimpinan" class="nav-link">
                                    <p>Pimpinan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/user/teknisi" class="nav-link">
                                    <p>Teknisi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/user/adminopd" class="nav-link">
                                    <p>Admin OPD</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/user/admin" class="nav-link">
                                    <p>Administrator</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/permohonan" class="nav-link">
                            <i class="fas fa-book-open nav-icon"></i>
                            <p>Permohonan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/permohonan/kategori" class="nav-link">
                            <i class="fas fa-clone nav-icon"></i>
                            <p>Kategori Permohonan</p>
                        </a>
                    </li>

                @elseif (Auth::user()->id_role == 4)
                    {{-- <!-- View Admin OPD --> --}}
                    <li class="nav-item">
                        <a href="{{ route('adminOpd') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('adminOpd.permohonan') }}" class="nav-link">
                            <i class="fas fa-book-open nav-icon"></i>
                            <p>Permohonan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('adminOpd.pedoman') }}" class="nav-link">
                            <i class="fas fa-align-justify nav-icon"></i>
                            <p>Pedoman Penggunaan</p>
                        </a>
                    </li>
                    </li>
                @else
                    return null;
                @endif

                <li class="nav-item">
                    <a href="/profile" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
        {{-- <!-- /.sidebar-menu --> --}}
    </div>
    {{-- <!-- /.sidebar --> --}}
</aside>
