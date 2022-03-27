<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountToSemiFinishedIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('semi_finished_ingredients', function (Blueprint $table) {
            $table->float('amount',8,3,false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('semi_finished_ingredients', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
}
