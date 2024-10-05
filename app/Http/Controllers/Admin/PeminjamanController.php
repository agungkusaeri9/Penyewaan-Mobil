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

            return redirect()->route('admin.peminjaman.index')->with('status', 'Status peminjaman berhasil diupdate.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.peminjaman.index')->with('error', 'Status peminjaman gagal diupdate.');
        }
    }
}
