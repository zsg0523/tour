<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buttons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('banner_id')->nullable();
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
            $table->string('link')->nullable()->comment('链接');
            $table->string('name')->nullable()->comment('名称');
            $table->string('icon')->nullable()->comment('图片');
            $table->integer('is_show')->default('1')->comment('是否显示');
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
        Schema::dropIfExists('buttons');
    }
}
