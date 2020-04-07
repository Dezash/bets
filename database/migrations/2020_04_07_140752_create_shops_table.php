<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('address');
            $table->string('phone', 255);
            $table->string('email');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->timestamps();
        });

        Schema::table('shops', function (Blueprint $table) {
            $table->bigInteger('department')->nullable()->unsigned();
            $table->foreign('department')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
