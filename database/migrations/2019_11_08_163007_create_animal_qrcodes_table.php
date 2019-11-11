<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalQrcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_qrcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('animal_id')->unsigned()->index();
            $table->string('lang')->nullable()->index();
            $table->string('url')->nullable()->comment('qrcode 内容');
            $table->string('qrcode')->nullable()->comment('二维码链接');
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
        Schema::dropIfExists('animal_qrcodes');
    }
}
