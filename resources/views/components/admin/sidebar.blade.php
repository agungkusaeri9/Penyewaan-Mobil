<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-chart-line  pr-2 icon-large"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.peminjaman.index') }}">
                <i class="mdi mdi-car-key  pr-2 icon-large"></i>
                <span class="menu-title">Peminjaman</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.pengembalian.index') }}">
                <i class="mdi  mdi-key-remove   pr-2 icon-large"></i>
                <span class="menu-title">Pengembalian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.mobil.index') }}">
                <i class="mdi mdi-car  pr-2 icon-large"></i>
                <span class="menu-title">Mobil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.merk.index') }}">
                <i class="mdi mdi-label  pr-2 icon-large"></i>
                <span class="menu-title">Merk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.metode-pembayaran.index') }}">
                <i class="mdi mdi-bank  pr-2 icon-large"></i>
                <span class="menu-title">Metode Pembayaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.customer.index') }}">
                <i class="mdi mdi-account  pr-2 icon-large"></i>
                <span class="menu-title">Customer</span>
            </a>
        </li>
    </ul>
</nav>
