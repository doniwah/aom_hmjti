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
        Schema::create('sponsorship_categori', function (Blueprint $table) {
            $table->id('id_sponsorship_categori'); // Primary key dengan nama khusus
            $table->string('name', 255); // Kolom name dengan panjang 255 karakter
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorship_categori');
    }
};
