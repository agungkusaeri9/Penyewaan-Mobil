@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="card-title mb-3 text-center">Edit Pengembalian</h4>
                    </div>
                    <form action="{{ route('admin.pengembalian.update', $item->uuid) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class='form-group mb-3'>
                            <label for='tanggal_pengembalian' class='mb-2'>Tanggal Pengembalian</label>
                            <input type='datetime-local' name='tanggal_pengembalian' id='tanggal_pengembalian'
                                class='form-control @error('tanggal_pengembalian') is-invalid @enderror'
                                value='{{ $item->tanggal_pengembalian->translatedFormat('Y-m-d H:i') ?? old('tanggal_pengembalian') }}'>
                            @error('tanggal_pengembalian')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='kondisi_mobil' class='mb-2'>Kondisi Mobil</label>
                            <textarea name='kondisi_mobil' id='kondisi_mobil' cols='30' rows='3'
                                class='form-control @error('kondisi_mobil') is-invalid @enderror'>{{ $item->kondisi_mobil ?? old('kondisi_mobil') }}</textarea>
                            @error('kondisi_mobil')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='total_denda' class='mb-2'>Total Denda</label>
                            <input type='number' name='total_denda' id='total_denda'
                                class='form-control @error('total_denda') is-invalid @enderror'
                                value='{{ $item->total_denda ?? old('total_denda') }}'>
                            @error('total_denda')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='catatan' class='mb-2'>Catatan</label>
                            <textarea name='catatan' id='catatan' cols='30' rows='3'
                                class='form-control @error('catatan') is-invalid @enderror'>{{ $item->catatan ?? old('catatan') }}</textarea>
                            @error('catatan')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group'>
                            <label for='status'>Status</label>
                            <select name='status' id='status'
                                class='form-control @error('status') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih status</option>
                                <option @selected($item->status == 0) value="0">Pending</option>
                                <option @selected($item->status == 1) value="1">Diperiksa</option>
                                <option @selected($item->status == 2) value="2">Selesai</option>
                                <option @selected($item->status == 3) value="3">Ditolak</option>
                                <option @selected($item->status == 4) value="4">Menunggu Pembayaran Denda</option>
                            </select>
                            @error('status')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Update Pengembalian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row mb-3">
                <div class="col-md-12">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="card-title mb-3 text-center">Detail Mobil</h4>
                            </div>
                            <img src="" class="img-fluid mb-3" alt="">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Merek</th>
                                        <td>:</td>
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
@endsection
<x-Admin.Sweetalert />
<x-Admin.Datatable />
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
