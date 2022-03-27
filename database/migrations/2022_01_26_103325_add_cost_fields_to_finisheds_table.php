<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostFieldsToFinishedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finisheds', function (Blueprint $table) {
            $table->float('freight',8,3)->default(0.0);
            $table->float('transport',8,3)->default(0.0);
            $table->float('loyalty',8,3)->default(0.0);
            $table->float('other',8,3)->default(0.0);
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finisheds', function (Blueprint $table) {
            $table->dropColumn('freight');
            $table->dropColumn('transport');
            $table->dropColumn('loyalty');
            $table->dropColumn('other');
            $table->dropColumn('notes');
        });
    }
}
