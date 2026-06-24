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
        Schema::create('m_jadwal_dokter', function (Blueprint $table) {
            $table->id();
            $table->integer('dokter_id');
            $table->string('hari_id');
            $table->string('jam_mulai_id');
            $table->string('jam_selesai_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_jadwal_dokter');
    }
};
