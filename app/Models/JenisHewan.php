<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    protected $guarded = [];

    // Satu Jenis "Punya Banyak" Hewan
    public function hewans()
    {
        return $this->hasMany(Hewan::class);
    }
}
