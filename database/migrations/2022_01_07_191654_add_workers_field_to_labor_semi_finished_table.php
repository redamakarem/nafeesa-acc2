<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkersFieldToLaborSemiFinishedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labor_semi_finished', function (Blueprint $table) {
            $table->integer('workers');
            $table->float('labor_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labor_semi_finished', function (Blueprint $table) {
            $table->dropColumn('workers');
            $table->dropColumn('labor_time');
        });
    }
}
