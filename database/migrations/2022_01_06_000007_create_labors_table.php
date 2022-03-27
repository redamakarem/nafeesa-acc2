<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborsTable extends Migration
{
    public function up()
    {
        Schema::create('labors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en');
            $table->string('title_ar');
            $table->float('basic_salary', 12, 3);
            $table->float('allowance', 12, 3)->nullable();
            $table->float('indemnity_expenses', 12, 3);
            $table->float('leave_expenses', 12, 3);
            $table->float('flat_rent', 12, 3);
            $table->float('medical_insurance', 12, 3);
            $table->float('visa_residency', 12, 3);
            $table->float('workers_insurance', 12, 3);
            $table->float('uniform_expenses', 12, 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
