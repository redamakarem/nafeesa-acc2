<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemiFinishedsTable extends Migration
{
    public function up()
    {
        Schema::create('semi_finisheds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_code');
            $table->string('name_en');
            $table->string('name_ar');
            $table->float('kilos_per_dough', 15, 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
