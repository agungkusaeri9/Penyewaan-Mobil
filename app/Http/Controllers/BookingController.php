<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

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
        return view('frontend.pages.booking.show', [
            'title' => 'Detail Mobil',
            'mobil' => $mobil
        ]);
    }
}
