<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('picture', 120)->nullable();
            $table->integer('age')->nullable();
            $table->string('state', 2);
            $table->string('city', 100);
            $table->string('gender', 1);
            $table->text('bio');
            $table->integer('staff_id')->nullable();
            $table->integer('points');
            $table->integer('first_weight')->nullable();
            $table->integer('last_weight')->nullable();
            $table->date('dt_operation')->nullable();
            $table->date('dt_end')->nullable();
            $table->integer('id_facebook');
            $table->integer('id_twitter');
            $table->integer('id_google');
            $table->integer('id_linkedin');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
