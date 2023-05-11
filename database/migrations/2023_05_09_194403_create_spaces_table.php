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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('neighborhood_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('type');
            $table->string('tv_type')->nullable();
            $table->boolean('balcony_access', 0);
            $table->string('bed_type')->nullable();
            $table->integer('tv_size')->default(0);
            $table->string('attached_bath_type')->nullable();
            $table->string('floor_type')->nullable();
            $table->boolean('usb_ports_near_bed', 0);
            $table->boolean('linens_provided', 0);
            $table->string('bath_type')->nullable();
            $table->integer('dining_seats')->default(0);
            $table->boolean('wet_bar', 0);
            $table->string('refrigerator_type')->nullable();
            $table->string('stove_type')->nullable();
            $table->boolean('microwave', 0);
            $table->boolean('dishwasher', 0);
            $table->boolean('fully_equipped', 0);
            $table->timestamps();

            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
