@extends('admin.layouts.app')
@section('content')
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-3">Filter</h4>
                    </div>
                    <form action="{{ route('admin.peminjaman.index') }}" method="get">
                        <div class="row">
                            <div class="col-md">
                                <div class='form-group mb-3'>
                                    <label for='tanggal_mulai' class='mb-2'>Tanggal Mulai </label>
                                    <input type='date' name='tanggal_mulai' id='tanggal_mulai'
                                        class='form-control @error('tanggal_mulai') is-invalid @enderror'
                                        value='{{ old('tanggal_mulai') }}'>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class='form-group'>
                                    <label for='tanggal_mulai' class='mb-2'>Status </label>
                                    <select name='status' id='status'
                                        class='form-control @error('status') is-invalid @enderror'>
                                        <option @selected(request('status') == 'all') value="all">Pilih Status</option>
                                        <option @selected(request('status') === '0') value="0">Menunggu Pembayaran</option>
                                        <option @selected(request('status') == 1) value="1">Proses Verifikasi Pembayaran
                                        </option>
                                        <option @selected(request('status') == 2) value="2">Pembayaran Diverifikasi</option>
                                        <option @selected(request('status') == 3) value="3">Sedang Dipinjam</option>
                                        <option @selected(request('status') == 4) value="4">Selesai</option>
                                        <option @selected(request('status') == 5) value="5">Batal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md align-self-end">
                                <div class='form-group'>
                                    <button class="btn py-3 text-white btn-secondary">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-3">Peminjaman</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Total Pembayaran</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
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
                                                <a href="{{ $item->bukti_pembayaran() }}" target="_blank"
                                                    class="btn btn-info btn-sm">Lihat</a>
                                            @else
                                                <i>Tidak Tersedia</i>
                                            @endif
                                        </td>
                                        <td>{!! $item->status() !!}</td>
                                        <td>
                                            <a href="{{ route('admin.peminjaman.edit', $item->uuid) }}"
                                                class="btn btn-sm py-2 btn-info">Edit</a>
                                            <a href="{{ route('admin.peminjaman.show', $item->uuid) }}"
                                                class="btn btn-sm py-2 btn-warning">Detail</a>
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
@endsection
<x-Admin.Sweetalert />
<x-Admin.Datatable />
