@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-3">Mobil</h4>
                        <a href="{{ route('admin.mobil.create') }}" class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Mobil</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Gambar</th>
                                    <th>Merk</th>
                                    <th>Model</th>
                                    <th>Nomor Plat</th>
                                    <th>Tarif /Hari</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ $item->gambar() }}" class="img-fluid" alt="">
                                        </td>
                                        <td>{{ $item->merek->nama ?? '-' }}</td>
                                        <td>{{ $item->model }}</td>
                                        <td>{{ $item->nomor_plat }}</td>
                                        <td>{{ formatRupiah($item->tarif_perhari) }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('admin.mobil.edit', $item->id) }}"
                                                class="btn btn-sm py-2 btn-info">Edit</a>
                                            <form action="javascript:void(0)" method="post" class="d-inline"
                                                id="formDelete">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                    data-action="{{ route('admin.mobil.destroy', $item->id) }}">Hapus</button>
                                            </form>
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
