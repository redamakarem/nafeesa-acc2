<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedRawMaterialPivotTable extends Migration
{
    public function up()
    {
        Schema::create('finished_raw_material', function (Blueprint $table) {
            $table->unsignedBigInteger('finished_id');
            $table->foreign('finished_id', 'finished_id_fk_5770354')->references('id')->on('finisheds')->onDelete('cascade');
            $table->unsignedBigInteger('raw_material_id');
            $table->foreign('raw_material_id', 'raw_material_id_fk_5770354')->references('id')->on('raw_materials')->onDelete('cascade');
        });
    }
}
