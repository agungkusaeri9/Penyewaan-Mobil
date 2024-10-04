@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Metode Pembayaran</h4>
                    <form action="{{ route('admin.metode-pembayaran.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class='form-group mb-3'>
                            <label for='nama' class='mb-2'>Nama</label>
                            <input type='text' name='nama' class='form-control @error('nama') is-invalid @enderror'
                                value='{{ old('nama') }}'>
                            @error('nama')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nomor_rekening' class='mb-2'>Nomor Rekening</label>
                            <input type='number' name='nomor_rekening' id='nomor_rekening'
                                class='form-control @error('nomor_rekening') is-invalid @enderror'
                                value='{{ old('nomor_rekening') }}'>
                            @error('nomor_rekening')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='pemilik' class='mb-2'>Pemilik</label>
                            <input type='text' name='pemilik' id='pemilik'
                                class='form-control @error('pemilik') is-invalid @enderror' value='{{ old('pemilik') }}'>
                            @error('pemilik')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('admin.metode-pembayaran.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Tambah Metode Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
