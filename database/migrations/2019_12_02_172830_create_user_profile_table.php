<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->string('user_id',37)->primary()->comment('UUID v4');
            $table->string('password_hash',64)->comment('BCrypt');
            $table->string('mail_address',256);
            $table->string('first_name',128);
            $table->string('last_name',128);
            $table->tinyInteger('role')->unsigned()->default(1)->comment('1: free_user 2. admin');
            $table->tinyInteger('delete_flg')->unsigned()->default(0)->comment('0: active 1: is deleted');
            $table->string('remember_token',100)->nullable()->comment('for Laravel save login');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile');
    }
}
