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
        Schema::create('plan_permissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plan_id')->unsigned();
            $table->bigInteger('permission_id')->unsigned();
            $table->timestamps();
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('permission_id')->references('id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_permission');
    }
};
