<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('material', function (Blueprint $table)
        {
            $table->id('material_id');
            $table->string('material_idf', 50)->unique();
            $table->string('material_title', 150);
            $table->unsignedBigInteger('material_counter_type_id')->default(1);
        });

        Schema::table('material', function ($table)
        {
            $table->foreign('material_counter_type_id')->references('material_counter_type_id')->on('material_counter_type');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material');
    }
}
