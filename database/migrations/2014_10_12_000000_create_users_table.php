<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('state_id')->defualt(1);
            $table->integer('safety_id');
            $table->integer('gender_id');
            $table->integer('vehicle_id')->default(1);
            $table->integer('assassination_id')->defualt(0);
            $table->integer('city_id')->default(1);
            $table->timestamp('crimeTime');
            $table->timestamp('travelTime');
            $table->integer('rank_id')->default(1);
            $table->text('cashHand')->default(500);
            $table->text('cashBank')->default(500);
            $table->boolean('eventsRead')->default(0);
            $table->boolean('admin');
            $table->integer('offence');
            $table->integer('defence');
            $table->integer('stealth');
            $table->integer('points');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
