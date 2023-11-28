<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->double('amount',10,2);
            $table->text('client_secret');
            $table->text('confirmation_method');
            $table->text('customer');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('trip_id')->unsigned();
            $table->string('payment_method',100);
            $table->string('charges_id',100);
            $table->string('card_id',100);
            $table->timestamps();
            $table->foreign('trip_id')->references('id')->on('bookings');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charges');
    }
};
