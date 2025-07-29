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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id (primary key, auto increment)
            $table->string('name', 50); // name varchar(50)
            $table->string('email', 255)->unique(); // email varchar(255) unique
            $table->timestamp('email_verified_at')->nullable(); // email_verified_at timestamp NULL
            $table->string('password', 255); // password varchar(255)
            $table->string('telp', 13); // telp varchar(13)
            $table->string('role', 5); // role varchar(5)
            $table->string('remember_token', 100)->nullable(); // remember_token varchar(100) NULL
            $table->timestamp('created_at')->nullable(); // created_at timestamp NULL
            $table->timestamp('updated_at')->nullable(); // updated_at timestamp NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
