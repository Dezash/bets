<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->timestamp('match_start')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('match_end')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('first_team')->unsigned();
            $table->foreign('first_team')->references('id')->on('teams');
            $table->bigInteger('second_team')->unsigned();
            $table->foreign('second_team')->references('id')->on('teams');
            $table->integer('first_team_score');
            $table->integer('second_team_score');
            $table->bigInteger('winning_team')->nullable()->unsigned();
            $table->foreign('winning_team')->references('id')->on('teams');
            $table->boolean('is_tie')->nullable();
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
        Schema::dropIfExists('matches');
    }
}
