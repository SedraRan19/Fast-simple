<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_payouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('driver_id')->unsigned()->index();
            $table->bigInteger('booking_id')->unsigned()->index()->nullable();
            $table->string('type',25);
            $table->double('amount',10,2)->default(0);
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
        });

        Schema::table('driver_payouts', function ($table) {
            $table->foreign('driver_id')->references('id')->on('drivers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('booking_id')->references('id')->on('bookings')
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
        Schema::dropIfExists('driver_payouts');
    }
}
