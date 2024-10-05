@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
        style="background-image: url('{{ asset('assets/frontend/img/carousel-bg-1.jpg') }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Riwayat Peminjaman</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Riwayat Peminjaman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Kode</th>
                                        <th>Mobil</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Total Bayar</th>
                                        <th>Bukti</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at->translatedFormat('d-m-Y H:i') }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->mobil->merek->nama . ' ' . $item->mobil->model }}</td>
                                            <td>{{ $item->tanggal_mulai->translatedFormat('d-m-Y H:i') }}</td>
                                            <td>{{ $item->tanggal_akhir->translatedFormat('d-m-Y H:i') }}</td>
                                            <td>{{ formatRupiah($item->total_bayar) }}</td>
                                            <td>
                                                @if ($item->bukti_pembayaran)
                                                    <a href="{{ $item->bukti_pembayaran() }}" target="_blank">Lihat</a>
                                                @else
                                                    <i>Tidak Tersedia</i>
                                                @endif
                                            </td>
                                            <td>
                                                {!! $item->status() !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('peminjaman.show', $item->uuid) }}"
                                                    class="btn btn-secondary btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
