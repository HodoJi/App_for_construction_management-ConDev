<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('courier_services', function (Blueprint $table)
        {
            $table->id();
            $table->string('service_code',255);
            $table->string('service_name',255);
            $table->unsignedBigInteger('courier_id');
            $table->timestamps();

            $table->foreign('courier_id')->references('id')->on('courier')
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
        Schema::dropIfExists('courier_services');
    }
}
