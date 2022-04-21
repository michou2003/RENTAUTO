<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_heure_debut');
            $table->dateTime('date_heure_retour');
            $table->tinyInteger('status');
            $table->double('avance');
            $table->string('car_immatriculation');
            $table->foreignId('client_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->foreign('car_immatriculation')->references('immatriculation')->on('cars');
            $table->double('net_a_payer')->nullable();
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
        Schema::dropIfExists('locations');
    }
}


