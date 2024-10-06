<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>CarMe</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto p-4 p-lg-0">
            <a href="{{ route('home') }}"
                class="nav-item nav-link @if (Route::is('home')) active @endif">Home</a>
            <a href="{{ route('booking.index') }}"
                class="nav-item nav-link @if (Route::is('booking.index')) active @elseif (Route::is('booking.show')) active @endif">Booking</a>
            <a href="{{ route('about') }}"
                class="nav-item nav-link @if (Route::is('tentang')) active @endif">About</a>
            <a href="{{ route('contact') }}"
                class="nav-item nav-link @if (Route::is('kontak')) active @endif">Contact</a>
            @guest
                <a href="{{ route('login') }}"
                    class="nav-item nav-link @if (Route::is('home')) active @endif">Login</a>
                <a href="{{ route('register') }}"
                    class="nav-item nav-link @if (Route::is('home')) active @endif">Register</a>
            @else
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown">{{ auth()->user()->name }}</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="{{ route('peminjaman.index') }}" class="dropdown-item">Riwayat Peminjaman</a>
                        <a href="{{ route('pengembalian.index') }}" class="dropdown-item">Riwayat Pengembalian</a>
                        <a href="#" class="dropdown-item"
                            onclick="document.getElementById('formLogout').submit()">Keluar</a>
                        <form action="{{ route('logout') }}" method="post" id="formLogout">
                            @csrf

                        </form>
                    </div>
                </div>
            @endguest
        </div>
        {{-- <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Booking Sekarang</a> --}}
    </div>
</nav>
