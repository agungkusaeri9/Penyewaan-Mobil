@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
        style="background-image: url({{ asset('assets/frontend/img/carousel-bg-1.jpg') }});">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">About Us</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">About</li>
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
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-car fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Layanan Berkualitas</h5>
                            <p>Kami menyediakan berbagai pilihan mobil dengan kondisi prima untuk memenuhi kebutuhan
                                perjalanan Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-users fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Tim Profesional</h5>
                            <p>Tim kami terdiri dari pekerja yang ahli dan berpengalaman di industri rental mobil, siap
                                melayani Anda dengan sepenuh hati.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-cogs fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Peralatan Modern</h5>
                            <p>Dengan dukungan peralatan modern, kami memastikan kendaraan selalu dalam kondisi terbaik
                                untuk kenyamanan dan keamanan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 pt-4" style="min-height: 400px;">
                    <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                        <img class="position-absolute img-fluid w-100 h-100"
                            src="{{ asset('assets/frontend/img/about.jpg') }}" style="object-fit: cover;" alt="">
                        <div class="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5"
                            style="background: rgba(0, 0, 0, .08);">
                            <h1 class="display-4 text-white mb-0">15 <span class="fs-4">Years</span></h1>
                            <h4 class="text-white">Experience</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-primary text-uppercase">// Tentang Kami //</h6>
                    <h1 class="mb-4"><span class="text-primary">CarMe</span> Tempat Terbaik untuk Sewa Mobil Anda</h1>
                    <p class="mb-4">Kami telah berpengalaman selama lebih dari 15 tahun dalam menyediakan layanan sewa
                        mobil
                        yang nyaman, aman, dan terpercaya. Dengan berbagai pilihan mobil yang selalu terawat, kami siap
                        memenuhi kebutuhan transportasi Anda, baik untuk perjalanan bisnis maupun liburan.</p>
                    <div class="row g-4 mb-3 pb-3">
                        <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                                    style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">01</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Profesional & Ahli</h6>
                                    <span>Tim kami selalu siap memberikan layanan terbaik dan solusi transportasi yang
                                        sesuai dengan kebutuhan Anda.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                                    style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">02</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Kualitas Mobil Terjamin</h6>
                                    <span>Semua kendaraan yang kami tawarkan selalu dalam kondisi prima dan siap digunakan
                                        kapan saja.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                                    style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">03</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Penghargaan & Prestasi</h6>
                                    <span>Kami telah meraih berbagai penghargaan atas kualitas layanan kami dalam industri
                                        rental mobil.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- About End -->
@endsection
