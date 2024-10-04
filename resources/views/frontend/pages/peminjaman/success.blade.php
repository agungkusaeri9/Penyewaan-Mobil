@extends('frontend.layouts.app')
@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <!-- Alert Success -->
            <div class="alert alert-success text-center">
                <h4 class="alert-heading">Peminjaman Mobil Berhasil!</h4>
                <p>Pengajuan pinjaman mobil Anda telah berhasil diproses. Silakan lakukan pembayaran sesuai instruksi
                    berikut.</p>
                <hr>
                <p class="mb-0">No Pinjaman: <strong>{{ $peminjaman->kode }}</strong></p>
            </div>

            <!-- Rincian Pinjaman -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Rincian Pinjaman Mobil
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Nama Peminjam: <strong>{{ $peminjaman->user->name }}</strong></li>
                        <li class="list-group-item">Merek Mobil: <strong>{{ $peminjaman->mobil->merek->nama }}</strong></li>
                        <li class="list-group-item">Model Mobil: <strong>{{ $peminjaman->mobil->model }}</strong></li>
                        <li class="list-group-item">Durasi: <strong>{{ $peminjaman->durasi }} hari</strong></li>
                        <li class="list-group-item">Tanggal Mulai:
                            <strong>{{ $peminjaman->tanggal_mulai->translatedFormat('d F Y H:i') }}</strong>
                        </li>
                        <li class="list-group-item">Tanggal Akhir:
                            <strong>{{ $peminjaman->tanggal_akhir->translatedFormat('d F Y H:i') }}</strong>
                        </li>
                        <li class="list-group-item">Total Pembayaran:
                            <strong>{{ formatRupiah($peminjaman->total_bayar) }}</strong>
                        </li>
                        <li class="list-group-item">Tanggal Pinjam:
                            <strong>{{ $peminjaman->created_at->translatedFormat('d F Y H:i') }}</strong>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Instruksi Pembayaran -->
            <div class="alert alert-warning mt-4">
                <h5 class="alert-heading">Instruksi Pembayaran</h5>
                <p>Silakan lakukan pembayaran ke nomor rekening berikut:</p>
                <p><strong>{{ $peminjaman->metode_pembayaran->nama }}:
                        {{ $peminjaman->metode_pembayaran->nomor_rekening }} a/n
                        {{ $peminjaman->metode_pembayaran->pemilik }}</strong></p>
                <p>Setelah melakukan pembayaran, jangan lupa untuk meng-upload bukti pembayaran di bawah ini.</p>
                <p><strong>Perhatian:</strong> Jika pembayaran tidak dilakukan dalam waktu 1 jam, pengajuan pinjaman Anda
                    akan otomatis dibatalkan.</p>
                @if ($peminjaman->bukti_pembayaran)
                    <a href="{{ $peminjaman->bukti_pembayaran() }}" target="_blank" class="btn btn-secondary">Lihat
                        Bukti</a>
                @else
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpload">
                        Upload Bukti Pembayaran
                    </button>
                @endif
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Modal -->
    <div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Bukti Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('peminjaman.upload-bukti', $peminjaman->uuid) }}" method="post"
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
