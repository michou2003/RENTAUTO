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
            $table->date('date_debut');
            $table->time('heure_debut');
            $table->date('date_retour');
            $table->time('heure_retour');
            $table->boolean('status');
            $table->string('car_immatriculation');
            $table->foreignId('client_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->foreign('car_immatriculation')->references('immatriculation')->on('cars');
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
