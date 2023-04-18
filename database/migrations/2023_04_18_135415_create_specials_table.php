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
        Schema::create('specials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('neighborhood_id')->nullable();
            $table->string('name');
            $table->text('description');
            $table->enum('type', ['fixed', 'percentage']);
            $table->float('amount');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specials');
    }
};
