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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('photo')->unique();
            $table->integer('games')->unsigned()->default(0);
            $table->float('avg_rate')->unsigned()->default(6.0);
            $table->integer('goals')->unsigned()->default(0);
            $table->integer('assists')->unsigned()->default(0);
            $table->integer('yellow_cards')->unsigned()->default(0);
            $table->integer('red_cards')->unsigned()->default(0);
            $table->boolean('is_default_in_squad')->default(false);
            $table->float('current_rate')->unsigned()->default(6.0);
            $table->integer('club_id')->unsigned();
            $table->integer('position_id')->unsigned();
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
        Schema::dropIfExists('players');
    }
};
