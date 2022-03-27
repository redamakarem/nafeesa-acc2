<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemiFinishedIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semi_finished_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('semi_finished_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('semi_finished_id')->references('id')->on('semi_finisheds')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('ingredient_id')->references('id')->on('semi_finisheds')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semi_finished_ingredients');
    }
}
