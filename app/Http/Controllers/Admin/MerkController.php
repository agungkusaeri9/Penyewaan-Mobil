<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MerkController extends Controller
{
    public function index()
    {
        $items = Merk::orderBy('nama', 'ASC')->get();
        return view('admin.pages.merk.index', [
            'title' => 'Merk',
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('admin.pages.merk.create', [
            'title' => 'Tambah item'
        ]);
    }

    public function store()
    {

        request()->validate([
            'nama' => ['required', 'unique:merek,nama'],
        ]);

        DB::beginTransaction();
        try {
            $data = request()->only(['nama']);
            Merk::create($data);
            DB::commit();
            return redirect()->route('admin.merk.index')->with('success', 'Merk berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $item = Merk::findOrFail($id);
        return view('admin.pages.merk.edit', [
            'title' => 'Edit Merk',
            'item' => $item
        ]);
    }

    public function update($id)
    {
        request()->validate([
            'nama' => ['required', 'unique:merek,nama,' . $id . ''],
        ]);

        DB::beginTransaction();
        try {
            $item = Merk::findOrFail($id);
            $data = request()->only(['nama']);
            $item->update($data);

            DB::commit();
            return redirect()->route('admin.merk.index')->with('success', 'Merk berhasil diupdate.');
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
            $item = Merk::findOrFail($id);
            $item->delete();
            DB::commit();
            return redirect()->route('admin.merk.index')->with('success', 'Merk berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
