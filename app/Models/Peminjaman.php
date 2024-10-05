<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $guarded = ['id'];
    public $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_akhir' => 'datetime',
    ];

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGetByUser($val)
    {
        $val->where('user_id', auth()->id());
    }

    public static function cekKetersediaan($tanggal, $durasi, $mobil_id)
    {
        $tanggal_sampai = Carbon::parse(request('tanggal'))->addDay($durasi);
        $cek = Peminjaman::whereBetween('tanggal_mulai', [$tanggal, $tanggal_sampai])->where('mobil_id', $mobil_id)->whereIn('status', [0, 1, 2, 3])->count();
        if ($cek > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function getNewCode()
    {
        $lastCode = DB::table('peminjaman')
            ->orderBy('id', 'desc')
            ->value('kode');

        // Menghasilkan kode baru
        if ($lastCode) {
            $number = (int) substr($lastCode, 3); // Mengambil nomor urut setelah awalan 'PNJ'
            $newNumber = str_pad($number + 1, 4, '0', STR_PAD_LEFT); // Menambahkan 1 dan mengisi dengan nol
            $newCode = 'PNJ' . $newNumber; // Membuat kode baru dengan awalan 'PNJ'
        } else {
            $newCode = 'PNJ0001'; // Kode awal jika belum ada data
        }

        return $newCode;
    }

    public function bukti_pembayaran()
    {
        return asset('storage/' . $this->bukti_pembayaran);
    }

    public function status()
    {
        // status peminjaman
        // 0 Menunggu Pembayaran
        // 1 Proses Verifikasi Pembayaran
        // 2 Pembayaran Diverifikasi
        // 3 Sedang Dipinjam
        // 4 Selesai
        // 5 Batal
        if ($this->status == 0) {
            return '<span class="p-2 badge badge-warning">Menunggu Pembayaran</span>';
        } elseif ($this->status == 1) {
            return '<span class="p-2 badge badge-warning">Proses Verifikasi Pembayaran</span>';
        } elseif ($this->status == 2) {
            return '<span class="p-2 badge badge-info">Pembayaran Diverifikasi</span>';
        } elseif ($this->status == 3) {
            return '<span class="p-2 badge badge-primary">Sedang Dipinjam</span>';
        } elseif ($this->status == 4) {
            return '<span class="p-2 badge badge-success">Selesai</span>';
        } else {
            return '<span class="p-2 badge badge-danger">Batal</span>';
        }
    }
}
