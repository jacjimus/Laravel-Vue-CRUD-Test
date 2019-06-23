<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name' , 50);
            $table->string('last_name' , 50);
            $table->string('phone' , 20);
            $table->string('address' , 100)->nullable();
            $table->string('city' , 100)->nullable();
            $table->string('country' , 50)->nullable();
            $table->string('fax' , 50)->nullable();
            $table->string('email' , 100);
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
        Schema::dropIfExists('customers');
    }
}
