<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePronosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pronos', function (Blueprint $table) {
            $table->increments('id_prono');
            $table->integer('id_match');
            $table->smallInteger('points_equipe1');
            $table->smallInteger('points_equipe2');
            $table->smallInteger('nb_essai_prono');
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pronos');
    }
}
