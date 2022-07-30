<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_players', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->integer('goals')->unsigned()->default(0);
            $table->integer('assists')->unsigned()->default(0);
            $table->integer('own_goals')->unsigned()->default(0);
            $table->integer('red_cards')->unsigned()->default(0);
            $table->integer('yellow_cards')->unsigned()->default(0);
            $table->float('rate')->unsigned()->default(6.0);
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
        Schema::dropIfExists('games_players');
    }
};
