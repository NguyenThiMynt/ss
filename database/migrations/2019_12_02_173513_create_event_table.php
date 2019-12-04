<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->bigIncrements('event_id')->unsigned()->comment('auto increment ');
            $table->string('event_name',50);
            $table->bigInteger('category_id')->unsigned();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('color',9)->comment('color hex code, Eg: #DCFF01');
            $table->string('event_content',512);
            $table->tinyInteger('delete_flg')->unsigned()->default(0)->comment('"0: active 1: is deleted"');
            $table->string('user_id',37);
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
        Schema::dropIfExists('event');
    }
}
