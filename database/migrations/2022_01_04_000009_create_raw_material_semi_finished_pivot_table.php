<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialSemiFinishedPivotTable extends Migration
{
    public function up()
    {
        Schema::create('raw_material_semi_finished', function (Blueprint $table) {
            $table->unsignedBigInteger('semi_finished_id');
            $table->foreign('semi_finished_id', 'semi_finished_id_fk_5730129')->references('id')->on('semi_finisheds')->onDelete('cascade');
            $table->unsignedBigInteger('raw_material_id');
            $table->foreign('raw_material_id', 'raw_material_id_fk_5730129')->references('id')->on('raw_materials')->onDelete('cascade');
        });
    }
}
