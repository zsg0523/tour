<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewToAnimaltranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animals_translations', function (Blueprint $table) {
            $table->integer('view')->nullable()->default('0')->after('lang')->comment('用户点击量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animals_translations', function (Blueprint $table) {
            $table->dropColumn('view');
        });
    }
}
