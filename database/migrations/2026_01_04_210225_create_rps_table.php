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
        Schema::create('rps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->onDelete('cascade');
            $table->string('tahun_ajaran', 10);
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('dosen_pengampu', 255);
            $table->text('capaian_pembelajaran');
            $table->string('prasyarat', 255)->nullable();
            $table->text('referensi');
            $table->text('metode_pembelajaran');
            $table->text('metode_penilaian');
            $table->string('qr_code_path', 255)->nullable();
            $table->string('qr_code_hash', 64)->nullable();
            $table->enum('status', ['Draft', 'Final'])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rps');
    }
};
