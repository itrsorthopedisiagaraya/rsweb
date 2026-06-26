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
        Schema::create('m_menu', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();

            // Laravel route name
            $table->string('route')->nullable();

            // Optional URL if not using route()
            $table->string('url')->nullable();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('m_menu')
                ->nullOnDelete();

            $table->integer('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            // Optional permission key
            $table->string('permission')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_menu');
    }
};
