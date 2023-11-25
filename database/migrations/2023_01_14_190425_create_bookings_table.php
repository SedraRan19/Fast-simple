<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->text('from_location');
            $table->text('to_location');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('start_time');
            $table->string('end_time')->nullable();
            $table->date('trip_date');
            $table->integer('passenger_count')->nullable();
            $table->string('passenger_phone')->nullable();
            $table->string('passenger_name')->nullable();
            $table->string('flight')->nullable();
            $table->double('price',10,2);
            $table->string('google_calendar_event_id')->nullable();
            $table->double('duration')->nullable();
            $table->integer('status')->default(0);
            $table->integer('refund_status')->default(0);
            $table->integer('cahrge_status')->default(0);
            $table->boolean('add_disclaimer')->nullable();
            $table->string('driver_payout')->nullable();
            $table->text('comments')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->bigInteger('vehicle_category_id')->unsigned();
            $table->bigInteger('vehicle_id')->unsigned()->index()->nullable();
            $table->bigInteger('driver_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('vehicle_category_id')->references('id')->on('vehicle_categories');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->softDeletes();
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
        Schema::dropIfExists('bookings');
    }
}
