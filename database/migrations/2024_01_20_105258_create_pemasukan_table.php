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
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis',['Transfer','Cash']);
            $table->foreignId('user_id');
            $table->foreignId('rekening_bank_dompet_id')->nullable();
            $table->string('deskripsi');
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
        Schema::dropIfExists('pemasukan');
    }
};
