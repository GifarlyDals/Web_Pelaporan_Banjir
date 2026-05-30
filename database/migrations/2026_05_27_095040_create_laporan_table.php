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
        Schema::create('laporan', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained("users")
                ->onDelete('cascade');

            $table->string('judul');

            $table->text('deskripsi');

            $table->integer('tinggi_air');

            $table->string('lokasi');

            $table->decimal('latitude', 10, 8)
                ->nullable();

            $table->decimal('longitude', 11, 8)
                ->nullable();

            $table->string('gambar')
                ->nullable();

            $table->enum('status', [
                'menunggu',
                'diverifikasi',
                'selesai',
                'ditolak'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
