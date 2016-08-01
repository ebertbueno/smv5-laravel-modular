<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Accounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) 
        {
            $table->integer('user_id')->unsigned()->index();
            $table->string('avatar');
            $table->string('provider');
            $table->string('provider_id');
            $table->string('id_card', 30);
            $table->string('local_person_code', 30);
            $table->date('birthdate');
            $table->string('gender', 10);
            $table->string('phonenumber', 20);
            $table->string('address');
            $table->string('address2');
            $table->string('city');
            $table->string('country');
            $table->string('zipcode', 10);
            $table->string('about');
            $table->string('website', 10);
            $table->string('confirmation_token');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accounts');
    }
}
