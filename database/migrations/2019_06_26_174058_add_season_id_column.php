<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeasonIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_prices', function (Blueprint $table) {
            $table->unsignedInteger('season_id');
            $table->foreign('season_id')->references('id')->on('seasons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_prices', function (Blueprint $table) {
            //
        });
    }
}
