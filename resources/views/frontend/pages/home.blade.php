@extends('frontend.layouts.app')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('assets/frontend') }}/img/carousel-bg-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Penyewaan Mobil //
                                    </h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Pusat Layanan Penyewaan
                                        Mobil Terpercaya</h1>
                                    <a href="{{ route('booking.index') }}"
                                        class="btn btn-primary py-3 px-5 animated slideInDown">Sewa Sekarang<i
                                            class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="{{ asset('assets/frontend') }}/img/carousel-1.png"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Carousel End -->


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

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="text-primary text-uppercase">// Testimonial //</h6>
                <h1 class="mb-5">Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3"
                        src="{{ asset('assets/frontend') }}/img/testimonial-1.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Deni Muhammad</h5>
                    <p>Pelanggan Setia</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Saya sudah beberapa kali menyewa mobil di sini, dan selalu puas dengan
                            pelayanannya. Mobil bersih, nyaman, dan proses peminjaman cepat.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3"
                        src="{{ asset('assets/frontend') }}/img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Agus Setiawan</h5>
                    <p>Pengusaha</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Layanan penyewaan mobil di sini sangat memuaskan. Mobil selalu dalam kondisi
                            prima dan siap pakai. Harga juga sangat bersaing.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3"
                        src="{{ asset('assets/frontend') }}/img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Rina Wijaya</h5>
                    <p>Karyawan Swasta</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Saya sangat merekomendasikan layanan penyewaan mobil ini. Pengalaman saya menyewa
                            mobil di sini sangat menyenangkan, mobil yang saya dapatkan selalu dalam kondisi bagus.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3"
                        src="{{ asset('assets/frontend') }}/img/testimonial-4.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Budi Santoso</h5>
                    <p>Traveler</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Pengalaman menyewa mobil untuk liburan bersama keluarga di sini sangat memuaskan.
                            Prosesnya mudah, pelayanannya ramah, dan mobilnya sangat nyaman untuk perjalanan jauh.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Testimonial End -->
@endsection
