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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_favourite')->default('0');
            $table->string('description')->default('N/A');
            $table->string('image');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('address')->default('N/A');
            $table->string('distance')->default('N/A');
            $table->string('by_car')->default('N/A');
            $table->string('by_public_transport')->default('N/A');
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
        Schema::dropIfExists('places');
    }
};
