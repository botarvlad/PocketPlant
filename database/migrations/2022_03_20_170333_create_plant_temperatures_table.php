<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantTemperaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_temperatures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plant_id')->unsigned()->nullable();
            $table->float('temp');
            
            $table->foreign('plant_id')->references('id')->on('plants');

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
        Schema::dropIfExists('plant_temperatures');
    }
}
