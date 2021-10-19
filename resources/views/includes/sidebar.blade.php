<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo mx-auto text-center mt-3">
                    <a href="{{ route('dashboard') }}">SPPD</a>
                    <p style="font-size:13px;">( Sistem Pendataan Penduduk Desa )</p>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ Request::url() == url('/') ? 'active' : ''}}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->role != 'Watcher')
                    <li class="sidebar-item  has-sub {{ (request()->is(['jobs*', 'residents*', 'users*'])) ? 'active' : ''}}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Data Master</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ request()->is('jobs*') ? 'active' : '' }}">
                                <a href="{{ route('jobs.index') }}">Data Pekerjaan</a>
                            </li>
                            <li class="submenu-item {{ request()->is('residents*') ? 'active' : '' }}">
                                <a href="{{ route('residents.index') }}">Data Penduduk</a>
                            </li>
                            @if(Auth::user()->role != 'Admin')
                                <li class="submenu-item {{ request()->is('users*') ? 'active' : '' }}">
                                    <a href="{{ route('users.index') }}">Users</a>
                            @endif
                        </ul>
                    </li>
                @endif

                <li class="sidebar-item  has-sub {{ (request()->is(['tetaps*', 'families*', 'births*', 'dies*', 'comes*', 'transfers*'])) ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Data Penduduk</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ request()->is('tetaps*') ? 'active' : '' }}">
                            <a href="{{ route('tetaps.index') }}">Penduduk Tetap</a>
                        </li>
                        <li class="submenu-item {{ request()->is('families*') ? 'active' : '' }}">
                            <a href="{{ route('families.index') }}">Data Keluarga</a>
                        </li>
                        <li class="submenu-item {{ request()->is('births*') ? 'active' : '' }}">
                            <a href="{{ route('births.index') }}">Data Kelahiran</a>
                        </li>
                        <li class="submenu-item {{ request()->is('dies*') ? 'active' : '' }}">
                            <a href="{{ route('dies.index') }}">Data Kematian</a>
                        <li class="submenu-item {{ request()->is('comes*') ? 'active' : '' }}">
                            <a href="{{ route('comes.index') }}">Penduduk Datang</a>
                        </li>
                        <li class="submenu-item {{ request()->is('transfers*') ? 'active' : '' }}">
                            <a href="{{ route('transfers.index') }}">Penduduk Pindah</a>
                        </li>
                        </li>
                    </ul>
                </li>

                {{-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="#">Laporan Tetap</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="#">Laporan Datang</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="#">Laporan Pindah</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="#">Laporan Meninggal</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="#">Laporan Lahir</a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-text-fill"></i>
                        <span>Surat</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="#">Surat Pindah</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="#">Surat PD</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="#">Surat Kelahiran</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="#">Surat Kematian</a>
                        </li>
                    </ul>
                </li> --}}

                <li class="sidebar-item">
                    <form action="{{ route('logout') }}" method="POST" class='sidebar-link'>
                        @csrf
                        <i class="bi bi-door-closed-fill"></i>
                        <button class="btn" style="color: #253a73; font-weight: 600; width: 100%; height: 100%; text-align: left;" type="submit">Logout</button>
                    </form>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
