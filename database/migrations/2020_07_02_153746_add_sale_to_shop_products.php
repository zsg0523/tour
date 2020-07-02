<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaleToShopProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_products', function (Blueprint $table) {
            $table->decimal('sales_price', 10, 2)->after('price');
            $table->boolean('sales')->default(0)->after('on_sale');
            $table->string('rebate')->nullable()->after('sales_price');
            $table->datetime('not_before')->nullable()->after('rebate');
            $table->datetime('not_after')->nullable()->after('not_before');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_products', function (Blueprint $table) {
            $table->dropColumn('sales_price');
            $table->dropColumn('sales');
            $table->dropColumn('rebate');
            $table->dropColumn('not_before');
            $table->dropColumn('not_after');
        });
    }
}
