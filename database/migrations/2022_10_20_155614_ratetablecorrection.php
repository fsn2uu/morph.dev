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
        Schema::table('rate_tables', function (Blueprint $table) {
            $table->dropColumn('complex_id');
            $table->integer('neighborhood_id')->before('unit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rate_tables', function (Blueprint $table) {
            $table->dropColumn('neighborhood_id');
        });
    }
};
