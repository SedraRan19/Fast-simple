<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->string('refund_id');
            $table->double('amount',10,2);
            $table->text('balance_transaction');
            $table->text('payment_intent');
            $table->text('user_id');
            $table->integer('customer_id');
            $table->string('charges_id',100);
            $table->string('currency',100);
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
        Schema::dropIfExists('refund');
    }
}
