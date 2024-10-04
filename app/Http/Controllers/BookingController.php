<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use App\Models\Mobil;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        $mobils = Mobil::paginate(12);
        return view('frontend.pages.booking.index', [
            'title' => 'Pilih mobil favorit kamu',
            'mobils' => $mobils
        ]);
    }

    public function show($id)
    {
        $mobil = Mobil::findOrFail($id);
        $data_metode_pembayaran = MetodePembayaran::orderBy('nama', 'ASC')->get();
        return view('frontend.pages.booking.show', [
            'title' => 'Detail Mobil',
            'data_metode_pembayaran' => $data_metode_pembayaran,
            'mobil' => $mobil
        ]);
    }

    public function cek_ketersediaan()
    {
        if (request()->ajax()) {

            $validator = Validator::make(request()->all(), [
                'mobil_id' => ['required', 'numeric'],
                'tanggal' => ['required', 'date'],
                'durasi' => ['required']
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => 422,
                    'errors' => $validator->errors(),
                    'message' => 'Validasi Error',
                    'total_bayar' => NULL
                ]);
            }
            $mobil_id = request('mobil_id');
            $tanggal = request('tanggal');
            $durasi = request('durasi');
            $mobil = Mobil::find($mobil_id);
            $cek = Peminjaman::cekKetersediaan($tanggal, $durasi, $mobil_id);
            $total_bayar = $durasi * $mobil->tarif_perhari;
            if ($cek == false) {
                return response()->json([
                    'status' => false,
                    'code' => 404,
                    'errors' => null,
                    'message' => 'Tidak Tersedia',
                    'total_bayar' => formatRupiah($total_bayar)
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'errors' => null,
                    'message' => 'Tersedia',
                    'total_bayar' => formatRupiah($total_bayar)
                ]);
            }
        }
    }
}
