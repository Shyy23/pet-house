<?php

namespace Database\Seeders;

use App\Models\Hewan;
use App\Models\JenisHewan;
use Illuminate\Database\Seeder;

class HewanSeeder extends Seeder
{
    public function run(): void
    {
        // Fungsi helper untuk ambil ID jenis dengan safe check
        $getJenisId = function ($namaJenis) {
            $jenis = JenisHewan::where('nama_jenis', $namaJenis)->first();
            return $jenis->id;
        };

        // Ambil ID semua jenis dengan aman
        $kucingId = $getJenisId('Kucing');
        $anjingId = $getJenisId('Anjing');
        $ikanId = $getJenisId('Ikan');
        $reptilId = $getJenisId('Reptil'); // FIX: Typo "Reptile" -> "Reptil"
        $hamsterId = $getJenisId('Hamster');
        $burungId = $getJenisId('Burung');
        $kelinciId = $getJenisId('Kelinci');

        $data = [
            
            [
                'jenis_hewan_id' => $kucingId,
                'nama' => 'Mochi',
                'jenis_kelamin' => 'Betina',
                'umur_bulan' => 12,
                'keterangan' => 'Bulu putih bersih, mata biru.',
                'foto' => null,
            ],

            [
                'jenis_hewan_id' => $kucingId,
                'nama' => 'Oyen',
                'jenis_kelamin' => 'Jantan',
                'umur_bulan' => 36,
                'keterangan' => 'Kucing oren barbar, tapi manja.',
                'foto' => null,
            ],
            
            [
                'jenis_hewan_id' => $anjingId,
                'nama' => 'Bobby',
                'jenis_kelamin' => 'Jantan',
                'umur_bulan' => 24,
                'keterangan' => 'Suka main bola, vaksin lengkap.',
                'foto' => null,
            ],
            
            [
                'jenis_hewan_id' => $ikanId,
                'nama' => 'Nemo ',
                'jenis_kelamin' => 'Jantan', // Anggap perwakilan
                'umur_bulan' => 5,
                'keterangan' => ' Clownfish, sehat lincah.',
                'foto' => null,
            ],
            
            [
                'jenis_hewan_id' => $reptilId,
                'nama' => 'Iggy',
                'jenis_kelamin' => 'Jantan',
                'umur_bulan' => 18,
                'keterangan' => 'Iguana hijau, makan lahap sayur.',
                'foto' => null,
            ],
            
            [
                'jenis_hewan_id' => $hamsterId,
                'nama' => 'Chika',
                'jenis_kelamin' => 'Betina',
                'umur_bulan' => 8,
                'keterangan' => 'Hamster roborovski aktif, suka lari di roda.',
                'foto' => null,
            ],

            [
                'jenis_hewan_id' => $burungId,
                'nama' => 'Rio',
                'jenis_kelamin' => 'Jantan',
                'umur_bulan' => 10,
                'keterangan' => 'Lovebird hijau, bisa menirukan suara.',
                'foto' => null,
            ],

            [
                'jenis_hewan_id' => $kelinciId,
                'nama' => 'Thumper',
                'jenis_kelamin' => 'Jantan',
                'umur_bulan' => 14,
                'keterangan' => 'Kelinci Holland Lop telinga turun, suka wortel.',
                'foto' => null,
            ],
        ];

        // Insert semua data sekaligus
        foreach ($data as $d) {
            Hewan::create($d);
        }

        $this->command->info('✅ Berhasil membuat 8 data hewan untuk 7 jenis hewan');
    }
}