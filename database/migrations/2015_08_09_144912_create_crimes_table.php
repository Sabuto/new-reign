<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crimes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('off_shown');
            $table->integer('def_shown');
            $table->integer('stl_shown');
            $table->integer('off_real');
            $table->integer('def_real');
            $table->integer('stl_real');
            $table->integer('points_needed');
            $table->integer('points');
            $table->integer('city_id')->unsigned();
            $table->text('success_message');
            $table->text('fail_message');
            $table->text('jail_message');
            $table->integer('min_money');
            $table->integer('max_money');
            $table->string('crime_timer');
            $table->string('jail_timer');

            $table->foreign('city_id')->references('id')->on('cities')->onCascade('delete');
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
        Schema::drop('crimes');
    }
}
