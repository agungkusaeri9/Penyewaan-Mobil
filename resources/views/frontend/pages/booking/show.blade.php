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
                            <form action="{{ route('peminjaman.pinjam') }}" method="post">
                                @csrf
                                <input type="number" name="mobil_id" id="mobil_id" hidden value="{{ $mobil->id }}">
                                <div class='form-group mb-3'>
                                    <label for='tanggal' class='mb-2'>Tanggal</label>
                                    <input type='datetime-local' name='tanggal' id='tanggal'
                                        min="{{ Carbon\Carbon::now()->translatedFormat('Y-m-d') }}"
                                        class='form-control @error('tanggal') is-invalid @enderror'
                                        value='{{ old('tanggal') }}'>
                                    @error('tanggal')
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
                                    <label for='metode_pembayaran_id' class="mb-2">Metode Pembayaran</label>
                                    <select name='metode_pembayaran_id' id='metode_pembayaran_id'
                                        class='form-control @error('metode_pembayaran_id') is-invalid @enderror'
                                        style="background: white">
                                        <option value='' selected disabled>Pilih Metode Pembayaran</option>
                                        @foreach ($data_metode_pembayaran as $metode_pembayaran)
                                            <option @selected($metode_pembayaran->id == old('metode_pembayaran_id')) value='{{ $metode_pembayaran->id }}'>
                                                {{ $metode_pembayaran->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('metode_pembayaran_id')
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
                                    <button type="button" class="btn w-100 mb-2 btnCek btn-secondary">Cek
                                        Ketersediaan</button>
                                    <button type="submit" class="btn w-100 mb-2 btnBooking d-none btn-primary">Booking
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

            function cekKetersediaan(mobil_id, tanggal, durasi) {
                $.ajax({
                    url: '{{ route('cek-ketersediaan') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            }

            $('.btnCek').on('click', function() {
                let mobil_id = $('#mobil_id').val();
                let tanggal = $('#tanggal').val();
                let durasi = $('#durasi').val();

                $('.error-message').remove();

                // cek ketersediaan
                $.ajax({
                    url: '{{ route('cek-ketersediaan') }}',
                    type: 'POST',
                    data: {
                        mobil_id,
                        tanggal,
                        durasi,
                        '_token': '{{ csrf_token() }}'
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.code == 422) {
                            let errors = response.errors;
                            // Iterasi setiap error dan tampilkan di form
                            $.each(errors, function(key, value) {
                                // Tambahkan error message di bawah input yang salah
                                let inputField = $('#' +
                                    key
                                ); // Pastikan id field sesuai dengan key dari errors
                                inputField.after(
                                    '<span class="error-message text-danger">' +
                                    value[0] + '</span>');
                            });

                            return false;
                        }
                        $('.status-ketersediaan').text(response.message);
                        $('#total_bayar').val(response.total_bayar);

                        if (response.status) {
                            $('.btnBooking').removeClass('d-none');
                        } else {
                            $('.btnBooking').addClass('d-none');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
