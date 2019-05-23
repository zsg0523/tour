<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->comment('电子书名称');
            $table->text('introduction')->nullable()->comment('简介');
            $table->string('cover')->nullable()->comment('封面图');
            $table->string('map')->nullable()->comment('地图');
            $table->integer('view')->default(0)->comment('浏览量');
            $table->boolean('is_release')->default(1)->comment('1发布，0不发布');
            $table->integer('created_userid')->nullable()->comment('创建人 id');
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
        Schema::dropIfExists('books');
    }
}
