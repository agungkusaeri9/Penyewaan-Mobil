<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $table = 'mobil';
    protected $guarded = ['id'];

    public function gambar()
    {
        return asset('storage/' . $this->gambar);
    }

    public function merek()
    {
        return $this->belongsTo(Merk::class, 'merek_id', 'id');
    }
}
