<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $items = MetodePembayaran::orderBy('nama', 'ASC')->get();
        return view('admin.pages.metode-pembayaran.index', [
            'title' => 'Merk',
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('admin.pages.metode-pembayaran.create', [
            'title' => 'Tambah Metode Pembayaran'
        ]);
    }

    public function store()
    {
        request()->validate([
            'nama' => ['required'],
            'nomor_rekening' => ['required'],
            'pemilik' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $data = request()->only(['nama', 'nomor_rekening', 'pemilik']);
            MetodePembayaran::create($data);
            DB::commit();
            return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $item = MetodePembayaran::findOrFail($id);
        return view('admin.pages.metode-pembayaran.edit', [
            'title' => 'Edit Merk',
            'item' => $item
        ]);
    }

    public function update($id)
    {
        request()->validate([
            'nama' => ['required'],
            'nomor_rekening' => ['required'],
            'pemilik' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $item = MetodePembayaran::findOrFail($id);
            $data = request()->only(['nama', 'nomor_rekening', 'pemilik']);
            $item->update($data);

            DB::commit();
            return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $item = MetodePembayaran::findOrFail($id);
            $item->delete();
            DB::commit();
            return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
