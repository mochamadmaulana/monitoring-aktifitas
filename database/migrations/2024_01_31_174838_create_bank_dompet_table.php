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
        Schema::create('bank_dompet', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis',['Bank','E-Dompet']);
            $table->string('nama');
            $table->string('logo','50')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_dompet');
    }
};
