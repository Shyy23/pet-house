<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hewans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel jenis_hewans
            // cascadeOnDelete artinya jika jenis 'Kucing' dihapus, semua data hewan kucing ikut terhapus (opsional)
            $table->foreignId('jenis_hewan_id')->constrained('jenis_hewans')->cascadeOnDelete();
            
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Jantan', 'Betina']);
            $table->integer('umur_bulan'); // Umur dalam bulan
            $table->string('foto')->nullable(); // Foto boleh kosong
            $table->text('keterangan')->nullable(); // Keterangan boleh kosong
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewans');
    }
};
