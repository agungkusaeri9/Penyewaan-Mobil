@extends('admin.layouts.app')
@section('content')
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-3">Filter</h4>
                    </div>
                    <form action="{{ route('admin.pengembalian.index') }}" method="get">
                        <div class="row">
                            <div class="col-md">
                                <div class='form-group mb-3'>
                                    <label for='tanggal_pengembalian' class='mb-2'>Tanggal Pengembalian </label>
                                    <input type='date' name='tanggal_pengembalian' id='tanggal_pengembalian'
                                        class='form-control @error('tanggal_pengembalian') is-invalid @enderror'
                                        value='{{ request('tanggal_pengembalian') ?? old('tanggal_pengembalian') }}'>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class='form-group'>
                                    <label for='status' class='mb-2'>Status </label>
                                    <select name='status' id='status'
                                        class='form-control @error('status') is-invalid @enderror'>
                                        <option @selected(request('status') == 'all') value="all">Pilih Status</option>
                                        <option @selected(request('status') == '0') value="0">Pending</option>
                                        <option @selected(request('status') == 1) value="1">Diperiksa</option>
                                        <option @selected(request('status') == 2) value="2">Selesai</option>
                                        <option @selected(request('status') == 3) value="3">Ditolak</option>
                                        <option @selected(request('status') == 4) value="4">Menunggu Pembayaran Denda
                                        </option>
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
                        <h4 class="card-title mb-3">Pengembalian</h4>
                        <a href="{{ route('admin.pengembalian.create') }}"
                            class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Pengembalian</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Kode</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal_pengembalian->translatedFormat('d-m-Y H:i') }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->peminjaman->mobil->merek->nama . ' ' . $item->peminjaman->mobil->model }}
                                        </td>
                                        <td>{{ $item->peminjaman->tanggal_mulai->translatedFormat('d-m-Y H:i') }}</td>
                                        <td>{{ $item->peminjaman->tanggal_akhir->translatedFormat('d-m-Y H:i') }}</td>
                                        <td>{!! $item->status() !!}</td>
                                        <td>
                                            @if ($item->status == 2)
                                                <a href="#" disabled
                                                    class="btn btn-sm py-2 btn-info disabled">Edit</a>
                                            @else
                                                <a href="{{ route('admin.pengembalian.edit', $item->uuid) }}"
                                                    class="btn btn-sm py-2 btn-info">Edit</a>
                                            @endif
                                            <a href="{{ route('admin.pengembalian.show', $item->uuid) }}"
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
