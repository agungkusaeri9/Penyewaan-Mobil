<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-chart-line  pr-2 icon-large"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.mobil.index') }}">
                <i class="mdi mdi-database  pr-2 icon-large"></i>
                <span class="menu-title">Mobil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.merk.index') }}">
                <i class="mdi mdi-database  pr-2 icon-large"></i>
                <span class="menu-title">Merk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2" href="{{ route('admin.customer.index') }}">
                <i class="mdi mdi-database  pr-2 icon-large"></i>
                <span class="menu-title">Customer</span>
            </a>
        </li>
    </ul>
</nav>
