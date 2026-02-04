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
        Schema::create('Product', function (Blueprint $table) {
            $table->id('ProductID');
            $table->string('Product_Name', 150);
            $table->text('Description')->nullable();
            $table->decimal('Price', 10, 2);
            $table->integer('Stock');
            $table->string('Image_URL', 255)->nullable();
            $table->foreignId('CategoryID')->constrained('Category', 'CategoryID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Product');
    }
};
