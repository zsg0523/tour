<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsNewsletterToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('language')->nullable()->comment('接收邮件的语言类型')->after('remember_token');
            $table->integer('is_newsletter')->default('0')->comment('是否接收新闻邮件')->after('language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('language');
            $table->dropColumn('is_newsletter');
        });
    }
}
