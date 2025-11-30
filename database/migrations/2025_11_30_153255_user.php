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
        Schema::create('User', function (Blueprint $table) {
            $table->id('UserID')->autoIncrement();
            $table->string('Name');
            $table->string('Email');
            $table->string('Password');
            $table->string('Phone')->nullable();
            $table->string('Addresss')->nullable();
            $table->string('Role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('User');
    }
};
