<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedLaborPivotTable extends Migration
{
    public function up()
    {
        Schema::create('finished_labor', function (Blueprint $table) {
            $table->unsignedBigInteger('finished_id');
            $table->foreign('finished_id', 'finished_id_fk_5770380')->references('id')->on('finisheds')->onDelete('cascade');
            $table->unsignedBigInteger('labor_id');
            $table->foreign('labor_id', 'labor_id_fk_5770380')->references('id')->on('labors')->onDelete('cascade');
        });
    }
}
