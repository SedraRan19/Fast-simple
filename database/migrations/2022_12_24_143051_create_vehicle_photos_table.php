<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_photos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_id')->unsigned()->index();
            $table->enum('image_type', ['exterior', 'interior']);
            $table->string('image',100);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('vehicle_photos', function ($table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_photos', function ($table) {
            $table->dropForeign(['vehicle_id']);
        });

        Schema::dropIfExists('vehicle_photos');
    }
}
