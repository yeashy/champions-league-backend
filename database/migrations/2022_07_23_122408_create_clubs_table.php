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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('logo')->unique();
            $table->integer('games')->unsigned()->default(0);
            $table->integer('wins')->unsigned()->default(0);
            $table->integer('draws')->unsigned()->default(0);
            $table->integer('losses')->unsigned()->default(0);
            $table->integer('goals_scored')->unsigned()->default(0);
            $table->integer('goals_conceded')->unsigned()->default(0);
            $table->integer('goal_difference')->unsigned()->default(0);
            $table->integer('points')->unsigned()->default(0);
            $table->integer('group_place')->unsigned()->default(0);
            $table->integer('group_id');
            $table->integer('stage_id');
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
        Schema::dropIfExists('clubs');
    }
};
