<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gunung');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->json('itinerary')->nullable();
            $table->decimal('harga', 12, 2);
            $table->integer('kuota');
            $table->integer('sisa_kuota');
            $table->string('level_kesulitan'); // e.g. Pemula, Menengah, Tinggi
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->string('status')->default('Aktif'); // e.g. Aktif, Penuh, Selesai, Batal
            $table->string('image_url')->nullable();
            $table->string('location')->nullable();
            $table->json('what_is_included')->nullable(); // inclusions & exclusions
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
