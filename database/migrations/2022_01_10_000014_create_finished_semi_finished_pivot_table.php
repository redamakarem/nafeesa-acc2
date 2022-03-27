<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedSemiFinishedPivotTable extends Migration
{
    public function up()
    {
        Schema::create('finished_semi_finished', function (Blueprint $table) {
            $table->unsignedBigInteger('finished_id');
            $table->foreign('finished_id', 'finished_id_fk_5770355')->references('id')->on('finisheds')->onDelete('cascade');
            $table->unsignedBigInteger('semi_finished_id');
            $table->foreign('semi_finished_id', 'semi_finished_id_fk_5770355')->references('id')->on('semi_finisheds')->onDelete('cascade');
        });
    }
}
