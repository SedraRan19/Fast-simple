<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('smtp_host',50)->nullable();
            $table->string('smtp_username',50)->nullable();
            $table->string('smtp_password',50)->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_address',100)->nullable();
            $table->text('stripe_public_key')->nullable();
            $table->text('stripe_secret_key')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->text('disclaimer_policy')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
