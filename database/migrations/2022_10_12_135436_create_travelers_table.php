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
        Schema::create('travelers', function (Blueprint $table) {
            $table->id();
            $table->string('first');
            $table->string('last');
            $table->string('email');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('stripe_customer_id')->nullable(); //we'll need this when we start charging so we can track specific users in Stripe
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
        Schema::dropIfExists('travelers');
    }
};
