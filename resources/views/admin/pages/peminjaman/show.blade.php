@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="card-title mb-3 text-center">Detail Pinjaman</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Tanggal Pinjam</th>
                                <td>:</td>
                                <td>{{ $item->created_at->translatedFormat('d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Kode</th>
                                <td>:</td>
                                <td>{{ $item->kode }}</td>
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
                                <th>Total Pembayaran</th>
                                <td>:</td>
                                <td>{{ formatRupiah($item->total_bayar) }}</td>
                            </tr>
                            <tr>
                                <th>Bukti Pembayaran</th>
                                <td>:</td>
                                <td>
                                    @if ($item->bukti_pembayaran)
                                        <a href="{{ $item->bukti_pembayaran() }}" target="_blank"
                                            class="btn btn-secondary btn-sm text-white">Lihat</a>
                                    @else
                                        <i>Tidak Tersedia</i>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>{!! $item->status() !!}</td>
                            </tr>
                            <tr>
                                <th>Aksi</th>
                                <td>:</td>
                                <td>
                                    <a href="{{ route('admin.peminjaman.index') }}"
                                        class="btn btn-sm btn-warning">Kembali</a>
                                    <a href="{{ route('admin.peminjaman.edit', $item->uuid) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="card-title mb-3 text-center">Detail Mobil</h4>
                            </div>
                            <img src="{{ $item->mobil->gambar() }}" class="img-fluid mb-3" alt="">
                            <div class="table-responsive">
                                <table class="table table-striped">
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
                                        <th>Nomor Plat</th>
                                        <td>:</td>
                                        <td>{{ $item->mobil->nomor_plat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tarif</th>
                                        <td>:</td>
                                        <td>{{ formatRupiah($item->mobil->tarif_perhari) }}/hari</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="card-title mb-3 text-center">Detail Customer</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $item->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. SIM</th>
                                        <td>:</td>
                                        <td>{{ $item->user->nomor_sim ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>:</td>
                                        <td>{{ $item->user->nomor_telepon ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ $item->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td>{{ $item->user->alamat ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
<x-Admin.Datatable />
