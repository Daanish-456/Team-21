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
        Schema::create('Orders', function(Blueprint $blueprint) {
            $blueprint->id('OrderID');
            $blueprint->integer('UserID');
            $blueprint->dateTime('OrderDate');
            $blueprint->string('OrderStatus', 50);
            $blueprint->decimal('TotalAmount', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Orders');
    }
};
