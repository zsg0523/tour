<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('theme_id')->unsigned()->index();
            $table->string('lang')->nullable()->defaule('en');
            $table->string('title_page')->nullable();
            $table->string('q1')->nullable();
            $table->string('a1')->nullable();
            $table->string('q2')->nullable();
            $table->string('a2')->nullable();
            $table->string('q3')->nullable();
            $table->string('a3')->nullable();
            $table->string('q4')->nullable();
            $table->string('a4')->nullable();
            $table->string('q5')->nullable();
            $table->string('a5')->nullable();
            $table->string('q6')->nullable();
            $table->string('a6')->nullable();
            $table->string('title_fun_fact')->nullable();
            $table->string('fun_fact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes_translations');
    }
}
