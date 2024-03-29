<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_rating', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('food_id');
            $table->unsignedInteger('rating_id');
            $table->timestamps();

            $table->foreign('food_id')
                ->references('id')
                ->on('foods')
                ->onDelete('cascade');

            $table->foreign('rating_id')
                ->references('id')
                ->on('ratings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_rating');
    }
}
