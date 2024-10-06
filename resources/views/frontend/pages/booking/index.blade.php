@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
        style="background-image: url('{{ asset('assets/frontend/img/carousel-bg-1.jpg') }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                @foreach ($mobils as $mobil)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="d-flex py-5 px-4">
                            <div class="ps-4">
                                <img src="{{ $mobil->gambar() }}" class="img-fluid mb-3" alt="">
                                <h5 class="mb-3">{{ $mobil->merek->nama . '  ' . $mobil->model }}</h5>
                                <h6>{{ formatRupiah($mobil->tarif_perhari) }} /hari</h6>
                                <p>{{ $mobil->deskripsi }}</p>
                                <a href="{{ route('booking.show', $mobil->id) }}"
                                    class="btn btn-primary w-100 border-bottom" href="">Booking</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $mobils->links() }}
        </div>
    </div>
    <!-- Service End -->
@endsection
