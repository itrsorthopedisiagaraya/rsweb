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
        Schema::create('r_user_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('no_hp');
            $table->string('jenis_kelamin')->nullable();
            $table->string('status');
            $table->date('tgl_lahir');
            $table->string('pendidikan');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->text('alamat_lengkap');
            $table->string('klinik_tujuan')->nullable();
            $table->string('warga_negara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_user_detail');
    }
};
