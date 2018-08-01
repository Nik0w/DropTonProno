<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->increments('id_match');
            $table->integer('id_equipe1');
            $table->integer('id_equipe2');
            $table->integer('id_journee');
            $table->smallInteger('score_equipe1');
            $table->smallInteger('score_equipe2');
            $table->smallInteger('nb_essai_match');
            $table->dateTime('date_debut_match');
            $table->dateTime('date_fin_match');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchs');
    }
}
