<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->string('immatriculation');
            $table->primary('immatriculation');
            $table->mediumText('marque');
            $table->mediumText('model');
            $table->mediumText('yearFabrication');
            $table->double('tarifLocation');
            $table->enum('status', ['Disponible', 'Indisponible']);
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
        Schema::dropIfExists('cars');
    }
}
