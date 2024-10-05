@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
        style="background-image: url('{{ asset('assets/frontend/img/carousel-bg-1.jpg') }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Detail Pinjaman</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Detail Pinjaman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center mb-5">Detail Mobil</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <img src="{{ $item->mobil->gambar() }}" class="img-fluid mb-3" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Merek</th>
                                        <td>:</td>
                                        <td>{{ $item->mobil->merek->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Model</th>
                                        <td>:</td>
                                        <td>{{ $item->mobil->model }}</td>
                                    </tr>
                                    <tr>
                                        <th>Plat Nomor</th>
                                        <td>:</td>
                                        <td>{{ $item->mobil->nomor_plat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tarif</th>
                                        <td>:</td>
                                        <td>{{ formatRupiah($item->mobil->tarif_perhari) }}/hari</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center mb-5">Detail Pinjaman</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Tanggal Pinjaman</th>
                                        <td>:</td>
                                        <td>{{ $item->created_at->translatedFormat('d-m-Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode</th>
                                        <td>:</td>
                                        <td>{{ $item->kode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Peminjam</th>
                                        <td>:</td>
                                        <td>{{ $item->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. SIM</th>
                                        <td>:</td>
                                        <td>{{ $item->user->nomor_sim ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Durasi</th>
                                        <td>:</td>
                                        <td>{{ $item->durasi }} hari</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <td>:</td>
                                        <td>{{ $item->tanggal_mulai->translatedFormat('d-m-Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Akhir</th>
                                        <td>:</td>
                                        <td>{{ $item->tanggal_akhir->translatedFormat('d-m-Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <td>:</td>
                                        <td>{{ $item->metode_pembayaran->nama . ' - ' . $item->metode_pembayaran->nomor_rekening . ' a.n ' . $item->metode_pembayaran->pemilik }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bukti</th>
                                        <td>:</td>
                                        <td>
                                            @if ($item->bukti_pembayaran)
                                                <a href="{{ $item->bukti_pembayaran() }}" target="_blank"
                                                    class="btn btn-secondary">Lihat
                                                    Bukti</a>
                                            @else
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalUpload">
                                                    Upload Bukti Pembayaran
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Pembayaran</th>
                                        <td>:</td>
                                        <td>{{ formatRupiah($item->total_bayar) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td>{!! $item->status2() !!}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <!-- Modal -->
    <div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Bukti Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('peminjaman.upload-bukti', $item->uuid) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class='form-group mb-3'>
                            <label for='bukti_pembayaran' class='mb-2'>Gambar <span class="small">
                                    (PNG/JPG/JPEG)</span></label>
                            <input type='file' name='bukti_pembayaran' id='bukti_pembayaran'
                                class='form-control @error('bukti_pembayaran') is-invalid @enderror'
                                value='{{ old('bukti_pembayaran') }}' style="background: white">
                            @error('bukti_pembayaran')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
