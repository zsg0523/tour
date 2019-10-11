<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->unsigned()->index();
            $table->integer('type')->default(10)->comment('10单品/20套装');
            $table->string('cover')->nullable()->comment('封面图');
            $table->string('name')->nullable()->index()->comment('名称');
            $table->string('code')->nullable()->index()->comment('编号');
            $table->string('local')->nullable()->comment('地区');
            $table->string('case')->nullable();
            $table->string('size')->nullable();
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
        Schema::dropIfExists('products');
    }
}
