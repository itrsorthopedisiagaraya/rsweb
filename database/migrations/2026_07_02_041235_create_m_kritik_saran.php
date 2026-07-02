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
        Schema::create('m_kritik_saran', function (Blueprint $table) {
            $table->id();

            // User Information
            $table->string('nama');
            $table->string('email');
            $table->string('no_telepon', 20);

            // Review
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->text('kritik_saran');

            // Optional image
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kritik_saran');
    }
};
