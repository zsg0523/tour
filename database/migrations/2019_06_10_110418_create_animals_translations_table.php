<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('animal_id')->unsigned()->index();
            $table->integer('sound_id')->unsigned()->index();
            $table->string('lang')->nullable()->index();
            $table->string('title')->nullable()->index();
            $table->string('genus')->nullable();
            $table->string('family')->nullable();
            $table->string('habitat')->nullable();
            $table->string('location')->nullable();
            $table->string('title_classification')->nullable();
            $table->string('classification')->nullable();
            $table->string('title_lifespan')->nullable();
            $table->string('lifespan')->nullable();
            $table->string('title_diet')->nullable();
            $table->string('diet')->nullable();
            $table->string('weight')->nullable();
            $table->string('speed')->nullable();
            $table->string('animal_height')->nullable();
            $table->string('title_fun_tips')->nullable();
            $table->string('fun_tips')->nullable();
            $table->string('endangered_level')->nullable();
            $table->string('theme_name')->nullable()->index();
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
        Schema::dropIfExists('animals_translations');
    }
}
