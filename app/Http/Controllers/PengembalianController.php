<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $items = Pengembalian::with(['peminjaman', 'peminjaman.user', 'peminjaman.mobil.merek'])->getByUser()->latest()->get();
        return view('frontend.pages.pengembalian.index', [
            'title' => 'Riwayat Pengembalian',
            'items' => $items
        ]);
    }

    public function show($uuid)
    {
        $item = Pengembalian::where('uuid', $uuid)->firstOrFail();
        return view('frontend.pages.pengembalian.show', [
            'title' => 'Detail Pengembalian',
            'item' => $item
        ]);
    }
}
