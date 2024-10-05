<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $items = Peminjaman::with(['metode_pembayaran', 'user', 'mobil']);
        $tanggal_mulai = request('tanggal_mulai');
        $status = request('status');
        if ($tanggal_mulai)
            $items->whereDate('tanggal_mulai', $tanggal_mulai);
        if ($status == '0' && $status != 'all')
            $items->where('status', $status);
        $data = $items->latest()->get();
        return view('admin.pages.peminjaman.index', [
            'title' => 'Data Peminjaman',
            'items' => $data
        ]);
    }

    public function show($uuid)
    {
        $item = Peminjaman::with(['metode_pembayaran', 'user', 'mobil'])->where('uuid', $uuid)->firstOrFail();
        return view('admin.pages.peminjaman.show', [
            'title' => 'Detail Peminjaman',
            'item' => $item
        ]);
    }

    public function edit($uuid)
    {
        $item = Peminjaman::with(['metode_pembayaran', 'user', 'mobil'])->where('uuid', $uuid)->firstOrFail();
        if ($item->status == 4 || $item->status == 3) {
            return redirect()->route('admin.peminjaman.index');
        }
        return view('admin.pages.peminjaman.edit', [
            'title' => 'Edit Peminjaman',
            'item' => $item
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'status' => ['required', 'numeric']
        ]);

        try {
            $item = Peminjaman::with(['metode_pembayaran', 'user', 'mobil'])->where('uuid', $uuid)->firstOrFail();
            $item->update([
                'status' => request('status')
            ]);

            return redirect()->route('admin.peminjaman.index')->with('success', 'Status peminjaman berhasil diupdate.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.peminjaman.index')->with('error', 'Status peminjaman gagal diupdate.');
        }
    }

    public function getJson()
    {
        if (request()->ajax()) {
            $item = Peminjaman::with(['metode_pembayaran', 'mobil.merek', 'user'])->find(request('id'));
            $item['metode_pembayaran_custom'] = $item->metode_pembayaran->nama . ' - ' . $item->metode_pembayaran->nomor_rekening . ' a.n ' . $item->metode_pembayaran->pemilik;
            $item['tanggal_custom'] = $item->created_at->translatedFormat('d-m-Y H:i');
            $item['tanggal_mulai_custom'] = $item->tanggal_mulai->translatedFormat('d-m-Y H:i');
            $item['tanggal_akhir_custom'] = $item->tanggal_akhir->translatedFormat('d-m-Y H:i');
            $item['total_bayar_custom'] = formatRupiah($item->total_bayar);
            $item['tarif_perhari_custom'] = formatRupiah($item->harga);
            if ($item) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Data Peminjaman ditemukan.',
                    'data' => $item
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 404,
                    'message' => 'Data Peminjaman tidak ditemukan.',
                    'data' => NULL
                ]);
            }
        }
    }
}
