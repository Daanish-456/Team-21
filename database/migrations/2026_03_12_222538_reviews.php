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
        Schema::create('Reviews', function (Blueprint $blueprint) {
            $blueprint->id('ReviewID');
            $blueprint->integer('UserID');
            $blueprint->integer('ProductID');
            $blueprint->integer('Rating');
            $blueprint->string('Comment');
            $blueprint->dateTime('ReviewDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Reviews');
    }
};
