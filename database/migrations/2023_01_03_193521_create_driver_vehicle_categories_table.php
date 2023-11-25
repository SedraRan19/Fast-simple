<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverVehicleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_vehicle_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('driver_id')->unsigned();
            $table->bigInteger('vehicle_category_id')->unsigned();
            $table->string('name',50);
            $table->float('price_per_hour',10,2);
            $table->float('price_per_mile',10,2);
            $table->float('base_price',10,2);
            $table->integer('included');
            $table->float('percentage',10,2);
            $table->integer('payout_calculation');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('driver_vehicle_categories', function ($table) {
            $table->foreign('driver_id')->references('id')->on('drivers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('vehicle_category_id')->references('id')->on('vehicle_categories')
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
        Schema::dropIfExists('driver_vehicle_categories');
    }
}
