<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSkuIdToCartItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_product_id')->after('user_id');
            $table->foreign('shop_product_id')->references('id')->on('shop_products')->onDelete('cascade');
            $table->dropForeign(['shop_product_sku_id']);
            $table->dropColumn('shop_product_sku_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['shop_product_id']);
            $table->dropColumn('shop_product_id');
            $table->unsignedBigInteger('shop_product_sku_id');
            $table->foreign('shop_product_sku_id')->references('id')->on('shop_product_skus')->onDelete('cascade');
        });
    }
}
