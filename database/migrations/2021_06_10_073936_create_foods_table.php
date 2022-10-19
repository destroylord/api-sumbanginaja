<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('images');
            $table->text('descriptions');
            $table->enum('status', ['ada', 'habis'])->nullable();
            $table->string('food_generate_code')->nullable();
            $table->time('payback_time');
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
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
        Schema::dropIfExists('foods');
    }
}
