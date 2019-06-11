<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('video_id')->unsigned()->nullable()->index();
            $table->integer('product_series_id')->unsigned()->index();
            $table->string('product_name')->index()->nullable();
            $table->string('image_family')->nullable();
            $table->string('image')->nullable();
            $table->string('code')->nullable();
            $table->string('image_endangeredLevel')->nullable();
            $table->string('icon_diet')->nullable();
            $table->string('background')->nullable();
            $table->string('back_button')->nullable();
            $table->string('sound_animal')->nullable();
            $table->string('background_bar')->nullable();
            $table->string('youtube_url')->nullable();
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
        Schema::dropIfExists('animals');
    }
}
