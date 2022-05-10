<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialOnConstructionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('material_on_construction', function (Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('construction_id');
            $table->unsignedBigInteger('material_id');
            $table->integer('stock_count')->default(1);
        });

        Schema::table('material_on_construction', function($table) {
            $table->foreign('construction_id')->references('id')->on('constructions');
            $table->foreign('material_id')->references('id')->on('material');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_on_construction');
    }
}
