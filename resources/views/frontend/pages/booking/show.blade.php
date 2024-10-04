@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item text-white active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center mb-4">
                        <img src="{{ $mobil->gambar() }}" class="img-fluid gambar-mobil" alt="">
                    </div>
                    <h3>{{ $mobil->merek->nama . ' ' . $mobil->model }}</h3>
                    <h5>{{ formatRupiah($mobil->tarif_perhari) }}</h5>
                    <p>Nomor Plat : {{ $mobil->nomor_plat }}</p>
                    <p>{!! $mobil->deskripsi !!}</p>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Form Peminjaman</h5>
                            <form action="" method="post">
                                @csrf
                                <input type="number" name="mobil_id" id="mobil_id" hidden>
                                <div class='form-group mb-3'>
                                    <label for='tanggal_awal' class='mb-2'>Tanggal</label>
                                    <input type='date' name='tanggal_awal' id='tanggal_awal'
                                        class='form-control @error('tanggal_awal') is-invalid @enderror'
                                        value='{{ old('tanggal_awal') }}'>
                                    @error('tanggal_awal')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='durasi' class='mb-2'>Durasi/hari</label>
                                    <input type='number' name='durasi' id='durasi'
                                        class='form-control @error('durasi') is-invalid @enderror'
                                        value='{{ old('durasi') }}'>
                                    @error('durasi')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='total_bayar' class='mb-2'>Total Bayar</label>
                                    <input type='text' name='total_bayar' id='total_bayar'
                                        class='form-control @error('total_bayar') is-invalid @enderror'
                                        value='{{ old('total_bayar') }}' readonly>
                                    @error('total_bayar')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <p>Status Ketersediaan : </p>
                                <p class="status-ketersediaan">Belum Dicek</p>
                                <div class="form-group flex justify-content-between">
                                    <button type="button" class="btn w-100 mb-2 btn-secondary">Cek Ketersediaan</button>
                                    <button type="button" class="btn w-100 mb-2 btnBooking d-none btn-primary">Booking
                                        Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
@push('styles')
    <style>
        .gambar-mobil {
            max-height: 420px
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(function() {
            $('.btnCek').on('click', function() {
                let mobil_id =
            })
        })
    </script>
@endpush
