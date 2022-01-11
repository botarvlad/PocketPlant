<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plant_id')->unsigned();
            $table->bigInteger('device_id')->unsigned();
            $table->float('umid_sol');
            $table->float('umid_atm');
            $table->float('temp');

            $table->foreign('plant_id')->references('id')->on('plants');
            $table->foreign('device_id')->references('id')->on('devices');

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
        Schema::dropIfExists('plant_data');
    }
}
