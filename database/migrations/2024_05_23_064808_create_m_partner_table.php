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
        Schema::create('m_partner', function (Blueprint $table) {
            $table->id();
            $table->string('nama_partner');
            $table->string('logo_partner');
            $table->string('link_partner');
            $table->string('deskripsi_partner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_partner');
    }
};
