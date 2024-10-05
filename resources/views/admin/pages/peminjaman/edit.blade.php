@extends('admin.layouts.app')
@section('content')
    <div class="row">
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
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="card-title mb-3 text-center">Detail Pinjaman</h4>
                    </div>
                    <form action="{{ route('admin.peminjaman.update', $item->uuid) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class='form-group mb-3'>
                            <label for='kode' class='mb-2'>Kode</label>
                            <input type='text' name='kode' id='kode'
                                class='form-control @error('kode') is-invalid @enderror'
                                value='{{ $item->kode ?? old('kode') }}' disabled>
                            @error('kode')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='durasi' class='mb-2'>Durasi</label>
                            <input type='text' name='durasi' id='durasi'
                                class='form-control @error('durasi') is-invalid @enderror'
                                value='{{ $item->durasi . ' hari' ?? old('durasi') }}' disabled>
                            @error('durasi')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='tanggal_mulai' class='mb-2'>Tanggal Mulai</label>
                            <input type='text' name='tanggal_mulai' id='tanggal_mulai'
                                class='form-control @error('tanggal_mulai') is-invalid @enderror'
                                value='{{ $item->tanggal_mulai->translatedFormat('d-m-Y H:i') ?? old('tanggal_mulai') }}'
                                disabled>
                            @error('tanggal_mulai')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='tanggal_akhir' class='mb-2'>Tanggal Akhir</label>
                            <input type='text' name='tanggal_akhir' id='tanggal_akhir'
                                class='form-control @error('tanggal_akhir') is-invalid @enderror'
                                value='{{ $item->tanggal_akhir->translatedFormat('d-m-Y H:i') ?? old('tanggal_akhir') }}'
                                disabled>
                            @error('tanggal_akhir')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='metode_pembayaran' class='mb-2'>Metode Pembayaran</label>
                            <input type='text' name='metode_pembayaran' id='metode_pembayaran'
                                class='form-control @error('metode_pembayaran') is-invalid @enderror'
                                value='{{ $item->metode_pembayaran->nama . ' - ' . $item->metode_pembayaran->nomor_rekening . ' a.n ' . $item->metode_pembayaran->pemilik }}'
                                disabled>
                            @error('metode_pembayaran')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='total_bayar' class='mb-2'>Total Pembayaran</label>
                            <input type='text' name='total_bayar' id='total_bayar'
                                class='form-control @error('total_bayar') is-invalid @enderror'
                                value='{{ formatRupiah($item->total_bayar) ?? old('total_bayar') }}' disabled>
                            @error('total_bayar')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <p>Bukti Pembayaran </p>
                        @if ($item->bukti_pembayaran)
                            <a href="{{ $item->bukti_pembayaran() }}" target="_blank"
                                class="btn btn-secondary btn-sm text-white">Lihat</a>
                        @else
                            <i>Tidak Tersedia</i>
                        @endif
                        <div class='form-group mt-3'>
                            <label for='status'>Status</label>
                            <select name='status' id='status'
                                class='form-control @error('status') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih Status</option>
                                <option @selected($item->status == 0) value="0">Menunggu Pembayaran</option>
                                <option @selected($item->status == 1) value="1">Proses Verifikasi Pembayaran</option>
                                <option @selected($item->status == 2) value="2">Pembayaran Diverifikasi</option>
                                <option @selected($item->status == 3) value="3">Sedang Dipinjam</option>
                                <option @selected($item->status == 5) value="5">Batal</option>
                            </select>
                            @error('status')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Update Peminjaman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
<x-Admin.Datatable />
