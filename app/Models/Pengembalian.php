<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $guarded = ['id'];
    public $casts = [
        'tanggal_pengembalian' => 'datetime',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public static function getNewCode()
    {
        $lastCode = DB::table('pengembalian')
            ->orderBy('id', 'desc')
            ->value('kode');

        // Menghasilkan kode baru
        if ($lastCode) {
            $number = (int) substr($lastCode, 3); // Mengambil nomor urut setelah awalan 'PNG'
            $newNumber = str_pad($number + 1, 4, '0', STR_PAD_LEFT); // Menambahkan 1 dan mengisi dengan nol
            $newCode = 'PNG' . $newNumber; // Membuat kode baru dengan awalan 'PNG'
        } else {
            $newCode = 'PNG0001'; // Kode awal jika belum ada data
        }

        return $newCode;
    }

    public function status()
    {
        // status peminjaman
        // 0 Pending
        // 1 Diperiksa
        // 2 Selesai
        // 3 Denda Dikenakan
        // 4 Ditolak
        // 5 Menunggu Pembayaran Denda
        if ($this->status == 0) {
            return '<span class="p-2 badge badge-warning">Pending</span>';
        } elseif ($this->status == 1) {
            return '<span class="p-2 badge badge-warning">Diperiksa</span>';
        } elseif ($this->status == 2) {
            return '<span class="p-2 badge badge-success">Selesai</span>';
        } elseif ($this->status == 3) {
            return '<span class="p-2 badge badge-danger">Ditolak</span>';
        } else {
            return '<span class="p-2 badge badge-info">Menunggu Pembayaran Denda</span>';
        }
    }
}
