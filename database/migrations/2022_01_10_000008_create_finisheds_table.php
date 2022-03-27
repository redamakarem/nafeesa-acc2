<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedsTable extends Migration
{
    public function up()
    {
        Schema::create('finisheds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_ar');
            $table->float('labour_time', 8, 3)->nullable();
            $table->float('kilos_per_dough', 8, 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
