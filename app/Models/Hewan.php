<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $guarded = []; // Agar semua kolom bisa diisi (Mass Assignment)

    // Hewan "Milik" satu Jenis
    public function jenis()
    {
        return $this->belongsTo(JenisHewan::class, 'jenis_hewan_id');
    }
}
