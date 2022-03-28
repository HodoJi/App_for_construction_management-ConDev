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
            $table->string('name', 100)->unique(); // :username
            $table->string('email', 250)->unique(); //: email
            $table->string('password', 250); //: password

            //$table->unsignedBigInteger('role_id'); // → MAY BE ADDED IN FUTURE.

            $table->timestamps(); /*: created_at & edited_at; */

            // foreign keys:
            //$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade'); // → MAY BE ADDED IN FUTURE.
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
