<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('room_type' , 50);
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('room_capacity', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('room_capacity' , 50);
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('rooms_manager', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('room_name' , 5);
            $table->unsignedInteger('hotel_id' );
            $table->unsignedInteger('room_type_id' );
            $table->unsignedInteger('room_capacity_id' );
            $table->string('room_image',100 );
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('room_type_id')->references('id')->on('room_types');
            $table->foreign('room_capacity_id')->references('id')->on('room_capacity');
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('RoomManager');
    }
}
