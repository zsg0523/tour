<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('book_id')->unsigned()->index();
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('image')->nullable()->comment('图片内容');
            $table->string('file')->nullable()->comment('音频文件');
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
        Schema::dropIfExists('book_contents');
    }
}
