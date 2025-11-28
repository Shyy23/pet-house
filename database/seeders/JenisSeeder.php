<?php

namespace Database\Seeders;

use App\Models\JenisHewan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisHewan::insert([
        ['nama_jenis' => 'Kucing'],
        ['nama_jenis' => 'Anjing'],
        ['nama_jenis' => 'Hamster'],
        ['nama_jenis' => 'Burung'],
        ['nama_jenis' => 'Kelinci'],
        ['nama_jenis' => 'Ikan' ],
        ['nama_jenis' => 'Reptil'],
    ]);
    }
}
