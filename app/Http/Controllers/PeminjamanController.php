<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{

    public function index()
    {
        $items = Peminjaman::with(['user', 'mobil', 'metode_pembayaran'])->getByUser()->latest()->get();
        return view('frontend.pages.peminjaman.index', [
            'title' => 'Riwayat Peminjaman',
            'items' => $items
        ]);
    }
    public function pinjam()
    {
        request()->validate([
            'mobil_id' => ['required', 'numeric'],
            'tanggal' => ['required'],
            'durasi' => ['required', 'numeric'],
            'metode_pembayaran_id' => ['required', 'numeric']
        ]);

        DB::beginTransaction();
        try {
            // cek ketersediaan
            $cek = Peminjaman::cekKetersediaan(request('tanggal'), request('durasi'), request('mobil_id'));
            if ($cek == false) {
                return redirect()->back()->with('error', 'Mobil tidak tersedia di tanggal tersebut.');
            }
            $data = request()->only(['mobil_id', 'metode_pembayaran_id', 'durasi']);
            $mobil = Mobil::findOrFail(request('mobil_id'));
            $data['uuid'] = \Str::uuid();
            $data['kode'] = Peminjaman::getNewCode();
            $data['tanggal_mulai'] = request('tanggal');
            $data['tanggal_akhir'] = Carbon::parse(request('tanggal'))->addDay(request('durasi'));
            $data['user_id'] = auth()->id();
            $data['harga'] = $mobil->tarif_perhari;
            $data['total_bayar'] = $mobil->tarif_perhari * request('durasi');
            $data['status'] = 0;
            $peminjaman = Peminjaman::create($data);
            DB::commit();
            return redirect()->route('peminjaman.success', $peminjaman->uuid)->with('success', 'Peminjaman berhasil disubmit. Silahkan lakukan pembayaran dibawah ini.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function success($uuid)
    {
        $peminjaman = Peminjaman::with('metode_pembayaran')->getByUser()->where('uuid', $uuid)->firstOrFail();
        return view('frontend.pages.peminjaman.success', [
            'title' => 'Peminjaman Berhasil',
            'peminjaman' => $peminjaman
        ]);
    }

    public function upload_bukti($uuid)
    {
        request()->validate([
            'bukti_pembayaran' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);
        try {
            $peminjaman = Peminjaman::with('metode_pembayaran')->getByUser()->where('uuid', $uuid)->firstOrFail();
            $peminjaman->update([
                'bukti_pembayaran' => request()->file('bukti_pembayaran')->store('bukti-pembayaran', 'public'),
                'status' => 1
            ]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show($uuid)
    {
        $item = Peminjaman::with(['user', 'mobil', 'metode_pembayaran'])->getByUser()->where('uuid', $uuid)->firstOrFail();
        return view('frontend.pages.peminjaman.show', [
            'title' => 'Detail Peminjaman',
            'item' => $item
        ]);
    }
}
