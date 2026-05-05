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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 15)->unique();
            $table->string('nama', 100);
            $table->string('email')->unique();
            $table->enum('jurusan', ['SI', 'TI', 'IF']); // Sesuaikan enumnya bro
            $table->decimal('ipk', 3, 2); // Kolom IPK yang tadi ilang
            $table->integer('semester'); // Kolom semester
            $table->boolean('aktif')->default(true); // Kolom aktif
            $table->string('foto')->nullable(); // Kolom foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
