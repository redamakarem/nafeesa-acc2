<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborSemiFinishedPivotTable extends Migration
{
    public function up()
    {
        Schema::create('labor_semi_finished', function (Blueprint $table) {
            $table->unsignedBigInteger('semi_finished_id');
            $table->foreign('semi_finished_id', 'semi_finished_id_fk_5751630')->references('id')->on('semi_finisheds')->onDelete('cascade');
            $table->unsignedBigInteger('labor_id');
            $table->foreign('labor_id', 'labor_id_fk_5751630')->references('id')->on('labors')->onDelete('cascade');
        });
    }
}
