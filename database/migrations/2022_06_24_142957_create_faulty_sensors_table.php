<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaultySensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faulty_sensors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sensor_id')->unsigned();
            $table->foreign('sensor_id')
                  ->references('id')
                  ->on('sensors')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('faulty_sensors');
    }
}
