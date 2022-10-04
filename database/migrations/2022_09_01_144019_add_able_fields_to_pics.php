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
        Schema::table('pics', function (Blueprint $table) {
            $table->integer('picable_id')->after('unit_id');
            $table->string('picable_type')->after('picable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pics', function (Blueprint $table) {
            //
        });
    }
};
