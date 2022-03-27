<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchFixedAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_fixed_asset', function (Blueprint $table) {
            $table->unsignedBigInteger('fixed_asset_id');
            $table->foreign('fixed_asset_id', 'fixed_asset_id_fk_5900906')->references('id')->on('fixed_assets')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id', 'branch_id_fk_5900906')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_fixed_asset');
    }
}
