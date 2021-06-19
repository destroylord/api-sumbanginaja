<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('images');
            $table->string('locations');
            $table->longText('descriptions');
            $table->enum('status', [0,1,2])->nullable();
            $table->string('event_generate_code')->nullable();
            $table->integer('community_id')->unsigned();
            $table->timestamps();

            $table->foreign('community_id')
                        ->references('id')
                        ->on('communities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
