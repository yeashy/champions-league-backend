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
        Schema::table('players', function (Blueprint $table) {
            $table->integer('clean_sheets')->default(0)->unsigned();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id')->unsigned();
            $table->string('path');
            $table->boolean('is_best')->default(false);
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
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('clean_sheets');
        });

        Schema::dropIfExists('videos');
    }
};
