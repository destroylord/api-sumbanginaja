<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_user', function (Blueprint $table) {
            $table->integer('community_id')->unsigned()->index();
            $table->foreign('community_id')
                        ->references('id')
                        ->on('communities')
                        ->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();

            $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade');

                        
            $table->primary(['community_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_user');
    }
}
