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
        Schema::create('pemasukan_rekening', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('rekening_id');
            $table->string('rekening_kredit',20);
            $table->string('deskripsi')->nullable();
            $table->double('nominal')->default(0);
            $table->string('bukti')->nullable();
            $table->date('tanggal');
            $table->time('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan_rekening');
    }
};
