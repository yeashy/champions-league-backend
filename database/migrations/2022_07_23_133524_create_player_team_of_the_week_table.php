<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_team_of_the_week', function (Blueprint $table) {
            $table->id();
            $table->integer('player_id')->unsigned();
            $table->integer('position_id')->unsigned();
            $table->integer('team_of_the_week_id')->unsigned();
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
        Schema::dropIfExists('player_team_of_the_week');
    }
};
