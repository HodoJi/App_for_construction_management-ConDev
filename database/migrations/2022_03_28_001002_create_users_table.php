<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 250)->unique(); //: email
            $table->string('personalId', 9)->unique(); //: personal login key
            $table->string('password')->default(bcrypt(0));
            $table->unsignedBigInteger('construction_id')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->timestamps(); /*: created_at & edited_at; */
        });

        Schema::table('users', function ($table)
        {
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('construction_id')->references('id')->on('constructions');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
