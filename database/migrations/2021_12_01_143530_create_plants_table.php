<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            // $table->string('room');
            $table->string('name');
            $table->string('species');
            $table->string('pot_type')->nullable();
            $table->float('pot_size', 8, 2 )->nullable();
            $table->string('soil_type')->nullable();
            $table->float('height', 8, 2)->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            //restul de date care vor fi luate din tabela cu nevoi esentiale 

            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('room_id')->references('id')->on('rooms');

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
        Schema::dropIfExists('plants');
    }
}
