<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('rules', function (Blueprint $table)
        {
            $table->id();
            $table->string('rule_name', 255);
            $table->string('value', 255);
            $table->boolean('active', true);
            $table->integer('priority');
            $table->unsignedBigInteger('courier_service_id');
            $table->unsignedBigInteger('eshop_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('predicate_id');
            $table->timestamps();

            $table->foreign('courier_service_id')->references('id')->on('courier_services')
                ->onDelete('cascade');
            $table->foreign('eshop_id')->references('id')->on('eshop')
                ->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subject')
                ->onDelete('cascade');
            $table->foreign('predicate_id')->references('id')->on('predicate')
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
        Schema::dropIfExists('rules');
    }
}
