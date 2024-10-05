@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
        style="background-image: url('{{ asset('assets/frontend/img/carousel-bg-1.jpg') }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Detail Pengembalian</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Detail Pengembalian</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="text-left">
                            <h4 class="card-title mb-4 ">Detail Pengembalian</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th style="width:220px">Tanggal Pengembalian</th>
                                    <td style="width:20px">:</td>
                                    <td>{{ $item->tanggal_pengembalian->translatedFormat('d-m-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Kode</th>
                                    <td>:</td>
                                    <td>{{ $item->kode }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>:</td>
                                    <td>{{ $item->kondisi }}</td>
                                </tr>
                                <tr>
                                    <th>Total Denda</th>
                                    <td>:</td>
                                    <td>{{ formatRupiah($item->total_denda) }}</td>
                                </tr>
                                <tr>
                                    <th>Catatan</th>
                                    <td>:</td>
                                    <td>{{ $item->catatan }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>{!! $item->status2() !!}</td>
                                </tr>
                                <tr>
                                    <th>Aksi</th>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ route('pengembalian.index') }}"
                                            class="btn btn-warning btn-sm">Kembali</a>
                                    </td>
                                </tr>
                            </table>
                            <div class="text-left">
                                <h4 class="card-title mb-4 ">Detail Pinjaman</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width:220px">Tanggal Pinjam</th>
                                        <td style="width:20px">:</td>
                                        <td id="v-peminjaman-tanggal"></td>
                                    </tr>
                                    <tr>
                                        <th>Kode</th>
                                        <td>:</td>
                                        <td id="v-peminjaman-kode"></td>
                                    </tr>
                                    <tr>
                                        <th>Durasi</th>
                                        <td>:</td>
                                        <td id="v-peminjaman-durasi"> 0 hari</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <td>:</td>
                                        <td id="v-peminjaman-tanggal-mulai"></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Akhir</th>
                                        <td>:</td>
                                        <td id="v-peminjaman-tanggal-akhir"></td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <td>:</td>
                                        <td id="v-peminjaman-metode-pembayaran">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Pembayaran</th>
                                        <td>:</td>
                                        <td id="v-peminjaman-total-bayar"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-left">
                                <h4 class="card-title mb-4 ">Detail Mobil</h4>
                            </div>
                            <img src="" class="img-fluid mb-3" alt="">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width:220px">Merek</th>
                                        <td style="width:20px">:</td>
                                        <td id="v-mobil-merek"></td>
                                    </tr>
                                    <tr>
                                        <th>Model</th>
                                        <td>:</td>
                                        <td id="v-mobil-model"></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Plat</th>
                                        <td>:</td>
                                        <td id="v-mobil-nomor-plat"></td>
                                    </tr>
                                    <tr>
                                        <th>Tarif</th>
                                        <td>:</td>
                                        <td id="v-mobil-tarif-perhari">-</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-left">
                                <h4 class="card-title mb-4 ">Detail Customer</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width:220px">Nama</th>
                                        <td style="width:20px">:</td>
                                        <td id="v-user-name"></td>
                                    </tr>
                                    <tr>
                                        <th>No. SIM</th>
                                        <td>:</td>
                                        <td id="v-user-nomor-sim"></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>:</td>
                                        <td id="v-user-nomor-telepon"></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td id="v-user-email"></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td id="v-user-alamat"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
@push('scripts')
    <script>
        $(function() {
            let id = '{{ $item->peminjaman_id }}';

            $.ajax({
                url: '{{ route('admin.peminjaman.getJson') }}',
                data: {
                    id
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status) {
                        let peminjaman = response.data;
                        $('#v-peminjaman-tanggal').text(peminjaman.tanggal_custom);
                        $('#v-peminjaman-kode').text(peminjaman.kode);
                        $('#v-peminjaman-durasi').text(peminjaman.durasi + ' hari');
                        $('#v-peminjaman-tanggal-mulai').text(peminjaman
                            .tanggal_mulai_custom);
                        $('#v-peminjaman-tanggal-akhir').text(peminjaman
                            .tanggal_akhir_custom);
                        $('#v-peminjaman-metode-pembayaran').text(peminjaman
                            .metode_pembayaran_custom);
                        $('#v-peminjaman-total-bayar').text(peminjaman
                            .total_bayar_custom);
                        $('#v-mobil-merek').text(peminjaman
                            .mobil.merek.nama);
                        $('#v-mobil-model').text(peminjaman
                            .mobil.model);
                        $('#v-mobil-nomor-plat').text(peminjaman
                            .mobil.nomor_plat);
                        $('#v-mobil-tarif-perhari').text(peminjaman
                            .tarif_perhari_custom);
                        $('#v-user-name').text(peminjaman
                            .user.name);
                        $('#v-user-nomor-sim').text(peminjaman
                            .user.nomor_sim);
                        $('#v-user-nomor-telepon').text(peminjaman
                            .user.nomor_telepon);
                        $('#v-user-alamat').text(peminjaman
                            .user.alamat);
                        $('#v-user-email').text(peminjaman
                            .user.email);
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        })
    </script>
@endpush
