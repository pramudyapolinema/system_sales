@include('layouts.stylesheet')
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('assets/AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Billy Beans</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/'. Auth::user()->fotoprofil) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
                @if (auth()->user()->level == "admin")
                <li class="nav-header">ADMIN</li>
                <li class="nav-item {{ (request()->is('admin', 'pelanggan')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin', 'pelanggan')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}">
                                <i class="far fa-crown nav-icon"></i>
                                <p>Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pelanggan.index') }}" class="nav-link {{ (request()->is('pelanggan')) ? 'active' : '' }}">
                                <i class="far fa-cog nav-icon"></i>
                                <p>Pelanggan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk.index') }}" class="nav-link {{ (request()->is('produk')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->level == "pelanggan")
                <li class="nav-header">Pelanggan</li>
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link {{ (request()->is('profile')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk.index') }}" class="nav-link {{ (request()->is('produk')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('keranjang.index')}}" class="nav-link {{ (request()->is('keranjang')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Keranjang
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item {{ (request()->is('transaksi/*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('transaksi/*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Data Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('prosesTransaksi') }}" class="nav-link {{ (request()->is('transaksi/diproses')) ? 'active' : '' }}">
                                <i class="far fa-box-alt nav-icon"></i>
                                <p>Diproses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kirimTransaksi') }}" class="nav-link {{ (request()->is('transaksi/dikirim')) ? 'active' : '' }}">
                                <i class="far fa-shipping-timed nav-icon"></i>
                                <p>Dikirim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('selesaiTransaksi') }}" class="nav-link {{ (request()->is('transaksi/selesai')) ? 'active' : '' }}">
                                <i class="far fa-check nav-icon"></i>
                                <p>Selesai</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
