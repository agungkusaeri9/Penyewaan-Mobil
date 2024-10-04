@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Mobil</h4>
                    <form action="{{ route('admin.mobil.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class='form-group'>
                            <label for='merek_id'>Merek</label>
                            <select name='merek_id' id='merek_id'
                                class='form-control @error('merek_id') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih Merek</option>
                                @foreach ($mereks as $merek)
                                    <option @selected($merek->id == old('merek_id')) value='{{ $merek->id }}'>{{ $merek->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('merek_id')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='model' class='mb-2'>Model</label>
                            <input type='text' name='model' id='model'
                                class='form-control @error('model') is-invalid @enderror' value='{{ old('model') }}'>
                            @error('model')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nomor_plat' class='mb-2'>Plat Nomor</label>
                            <input type='text' name='nomor_plat' id='nomor_plat'
                                class='form-control @error('nomor_plat') is-invalid @enderror'
                                value='{{ old('nomor_plat') }}'>
                            @error('nomor_plat')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='tarif_perhari' class='mb-2'>Tarif /Hari</label>
                            <input type='number' name='tarif_perhari' id='tarif_perhari'
                                class='form-control @error('tarif_perhari') is-invalid @enderror'
                                value='{{ old('tarif_perhari') }}'>
                            @error('tarif_perhari')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='deskripsi' class='mb-2'>Deskripsi</label>
                            <textarea name='deskripsi' id='deskripsi' cols='30' rows='3'
                                class='form-control @error('deskripsi') is-invalid @enderror'>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='gambar' class='mb-2'>Gambar</label>
                            <input type='file' name='gambar' id='gambar'
                                class='form-control @error('gambar') is-invalid @enderror' value='{{ old('gambar') }}'>
                            @error('gambar')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('admin.mobil.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Tambah Mobil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
