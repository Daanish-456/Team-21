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
        Schema::table('Cart_Item', function (Blueprint $table) {
            $table->char('Size', 2)->default('')->after('ProductID');
        });

        Schema::table('Order_Item', function (Blueprint $table) {
            $table->dropPrimary(['OrderID', 'ProductID']);
            $table->char('Size', 2)->default('')->after('ProductID');
            $table->primary(['OrderID', 'ProductID', 'Size']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Order_Item', function (Blueprint $table) {
            $table->dropPrimary(['OrderID', 'ProductID', 'Size']);
            $table->dropColumn('Size');
            $table->primary(['OrderID', 'ProductID']);
        });

        Schema::table('Cart_Item', function (Blueprint $table) {
            $table->dropColumn('Size');
        });
    }
};
