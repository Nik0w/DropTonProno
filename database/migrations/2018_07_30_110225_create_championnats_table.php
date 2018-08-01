<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChampionnatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('championnats', function (Blueprint $table) {
            $table->increments('id_championnat');
            $table->char('nom_championnat',100);
            $table->dateTime('date_debut_championnat');
            $table->dateTime('date_fin_championnat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('championnats');
    }
}
