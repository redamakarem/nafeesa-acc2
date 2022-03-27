<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSemiFinishedsTable extends Migration
{
    public function up()
    {
        Schema::table('semi_finisheds', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id', 'unit_fk_5784766')->references('id')->on('units');
        });
    }
}
