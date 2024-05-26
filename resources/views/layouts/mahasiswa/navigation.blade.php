    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{ route('admin.profile.show') }}" class="d-block">{{ Auth::user()->name ?? 'Guest' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Users') }}
                        </p>
                    </a>
                </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.khs.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>KHS</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{ route('admin.transkrip_nilai.index') }}" class="nav-link">
                                <i the="far fa-circle nav-icon"></i>
                                <p>Cetak Transkrip</p>
                            </a>
                        </li> -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dosen</p>
                            </a>
                        </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->