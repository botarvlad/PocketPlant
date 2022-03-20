<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantAirHumiditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_air_humidities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plant_id')->unsigned()->nullable();
            $table->float('umid_atm');
            
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
        Schema::dropIfExists('plant_air_humidities');
    }
}
