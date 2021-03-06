<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailToAnimalsTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animals_translations', function (Blueprint $table) {
            $table->text('about')->nullable()->after('group_name');
            $table->text('more_details')->nullable()->after('about');
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
            $table->dropcolumn('about');
            $table->dropcolumn('more_details');
        });
    }
}
