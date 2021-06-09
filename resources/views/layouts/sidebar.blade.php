<aside class="main-sidebar sidebar-light-lime elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('dist/img/logo_mi.png') }}" alt="Logo MI" class="brand-image " style="opacity: .8">
        <span class="brand-text font-weight-bold">MI Nurul Ahmad</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/avatar_man.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ set_active('home') }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @php
                    $menuDatamaster = ['kelas', 'siswa', 'tahun-ajaran', 'kategori-mapel', 'mata-pelajaran', 'ekstrakurikuler'];
                @endphp
                <li class="nav-item {{ set_active($menuDatamaster, 'menu-open') }}">
                    <a href="#" class="nav-link {{ set_active($menuDatamaster) }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Datamaster
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tahun-ajaran') }}" class="nav-link {{ set_active('tahun-ajaran') }}">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>Tahun Ajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kelas') }}" class="nav-link {{ set_active('kelas') }}">
                                <i class="fas fa-layer-group nav-icon"></i>
                                <p>Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('siswa') }}" class="nav-link {{ set_active('siswa') }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kategori-mapel') }}" class="nav-link {{ set_active('kategori-mapel') }}">
                                <i class="fas fa-tag nav-icon"></i>
                                <p>Kategori Mapel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mata-pelajaran') }}" class="nav-link {{ set_active('mata-pelajaran') }}">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ekstrakurikuler') }}" class="nav-link {{ set_active('ekstrakurikuler') }}">
                                <i class="fas fa-running nav-icon"></i>
                                <p>Ekstrakurikuler</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('raport') }}" class="nav-link {{ set_active('raport') }}">
                        <i class="fas fa-book nav-icon"></i>
                        <p>Nilai Raport</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
