<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merk;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        $items = Mobil::with('merek')->get();
        return view('admin.pages.mobil.index', [
            'title' => 'Mobil',
            'items' => $items
        ]);
    }

    public function create()
    {
        $mereks = Merk::orderBy('nama', 'ASC')->get();
        return view('admin.pages.mobil.create', [
            'title' => 'Tambah Mobil',
            'mereks' => $mereks
        ]);
    }

    public function store()
    {
        request()->validate([
            'merek_id' => ['required', 'numeric'],
            'model' => ['required'],
            'nomor_plat' => ['required'],
            'tarif_perhari' => ['required', 'numeric'],
            'deskripsi' => ['required'],
            'gambar' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,webp'],
        ]);
        DB::beginTransaction();
        try {
            $data = request()->only(['merek_id', 'model', 'nomor_plat', 'tarif_perhari', 'deskripsi']);
            $data['gambar'] = request()->file('gambar')->store('mobil', 'public');
            Mobil::create($data);
            DB::commit();
            return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $item = Mobil::findOrFail($id);
        $mereks = Merk::orderBy('nama', 'ASC')->get();
        return view('admin.pages.mobil.edit', [
            'title' => 'Edit Mobil',
            'item' => $item,
            'mereks' => $mereks
        ]);
    }

    public function update($id)
    {
        request()->validate([
            'merek_id' => ['required', 'numeric'],
            'model' => ['required'],
            'nomor_plat' => ['required'],
            'tarif_perhari' => ['required', 'numeric'],
            'deskripsi' => ['required'],
            'gambar' => ['image', 'mimes:png,jpg,jpeg,svg,webp'],
        ]);
        DB::beginTransaction();
        try {
            $item = Mobil::findOrFail($id);
            $data = request()->only(['merek_id', 'model', 'nomor_plat', 'tarif_perhari', 'deskripsi']);
            if (request()->file('gambar')) {
                Storage::disk('public')->delete($item->gambar);
                $data['gambar'] = request()->file('gambar')->store('mobil', 'public');
            }
            $item->update($data);
            DB::commit();
            return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil diupdate.');
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
            $item = Mobil::findOrFail($id);
            $item->delete();
            DB::commit();
            return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
