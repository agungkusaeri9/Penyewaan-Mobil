<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $items = Pengembalian::with(['peminjaman', 'peminjaman.user', 'peminjaman.mobil.merek']);
        $tanggal_pengembalian = request('tanggal_pengembalian');
        $status = request('status');
        if ($tanggal_pengembalian) {
            // dd('ada');
            $items->whereDate('tanggal_pengembalian', $tanggal_pengembalian);
        }
        if ($status != NULL && $status !== 'all' || $status === '0') {
            $items->where('status', $status);
        }
        $data = $items->latest()->get();
        return view('admin.pages.pengembalian.index', [
            'title' => 'Data Pengembalian',
            'items' => $data
        ]);
    }

    public function create()
    {
        $data_peminjaman = Peminjaman::whereDoesntHave('pengembalian')->where('status', 3)->latest()->get();
        return view('admin.pages.pengembalian.create', [
            'title' => 'Data Pengembalian',
            'data_peminjaman' => $data_peminjaman
        ]);
    }

    public function store()
    {
        request()->validate([
            'peminjaman_id' => ['required', 'numeric'],
            'tanggal_pengembalian' => ['required', 'date'],
            'status' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $data = request()->only(['peminjaman_id', 'tanggal_pengembalian', 'kondisi_mobil', 'total_denda', 'catatan', 'status']);
            $data['uuid'] = \Str::uuid();
            $data['kode'] = Pengembalian::getNewCode();
            $peminjaman = Peminjaman::findOrFail(request('peminjaman_id'));
            // jika selesai, maka peminjaman juga selesai
            if (request('status') == 2) {
                $peminjaman->update([
                    'status' => 4
                ]);
            }
            Pengembalian::create($data);
            DB::commit();
            return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil ditambahkan.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('admin.pengembalian.index')->with('error', $th->getMessage());
        }
    }

    public function edit($uuid)
    {
        $item = Pengembalian::where('uuid', $uuid)->firstOrFail();
        if ($item->status == 2) {
            return redirect()->route('admin.pengembalian.index');
        }
        return view('admin.pages.pengembalian.edit', [
            'title' => 'Edit Pengembalian',
            'item' => $item
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'tanggal_pengembalian' => ['required', 'date'],
            'status' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $data = request()->only(['tanggal_pengembalian', 'kondisi_mobil', 'total_denda', 'catatan', 'status']);
            $item = Pengembalian::where('uuid', $uuid)->firstOrFail();
            // jika selesai, maka peminjaman juga selesai
            if ($item->status != 2 && request('status') == 2) {
                $item->peminjaman()->update([
                    'status' => 4
                ]);
            }
            $item->update($data);
            DB::commit();
            return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil diupdate.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('admin.pengembalian.index')->with('error', $th->getMessage());
        }
    }

    public function show($uuid)
    {
        $item = Pengembalian::where('uuid', $uuid)->firstOrFail();
        return view('admin.pages.pengembalian.show', [
            'title' => 'Detail Pengembalian',
            'item' => $item
        ]);
    }
}
