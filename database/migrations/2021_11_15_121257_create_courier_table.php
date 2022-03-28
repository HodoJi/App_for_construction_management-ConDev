<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('courier', function (Blueprint $table)
        {
            $table->id();
            $table->string('courier_code');
            $table->string('courier_name');
            $table->unsignedBigInteger('eshop_id');
            $table->timestamps();

            $table->foreign('eshop_id')->references('id')->on('eshop')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courier');
    }
}
