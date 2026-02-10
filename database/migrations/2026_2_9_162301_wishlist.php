<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Wishlist', function (Blueprint $table) {
            $table->id('WishlistID');
            $table->integer('UserID');
        });

        Schema::create('Wishlist_Item', function (Blueprint $table) {
            $table->integer('WishlistID');
            $table->integer('ProductID');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Wishlist_Item');
        Schema::dropIfExists('Wishlist');
    }
};
