<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSfLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_lockers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lang')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('code')->nullable();
            $table->string('address')->nullable();
            $table->string('business_time')->nullable()->comment('营业时间');
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
        Schema::dropIfExists('sf_lockers');
    }
}
