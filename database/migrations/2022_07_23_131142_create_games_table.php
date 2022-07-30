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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('home_club_id')->unsigned();
            $table->integer('away_club_id')->unsigned();
            $table->integer('winner_club_id')->unsigned()->nullable();
            $table->integer('loser_club_id')->unsigned()->nullable();
            $table->integer('home_scored')->unsigned()->nullable();
            $table->integer('away_scored')->unsigned()->nullable();
            $table->boolean('has_played')->default(false);
            $table->integer('stage_id')->unsigned();
            $table->integer('group_id')->unsigned()->nullable();
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
        Schema::dropIfExists('games');
    }
};
