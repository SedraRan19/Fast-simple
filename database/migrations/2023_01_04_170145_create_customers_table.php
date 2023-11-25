<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('email',50);
            $table->string('phone');
            $table->text('home_address')->nullable();
            $table->text('office_address')->nullable();
            $table->text('permanent_note')->nullable();
            $table->text('private_general_notes')->nullable();
            $table->text('driver_notes')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('strip_id')->nullable();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('parent_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
