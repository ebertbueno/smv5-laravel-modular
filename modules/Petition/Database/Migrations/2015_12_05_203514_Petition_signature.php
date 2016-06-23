<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PetitionSignature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('petition_signature', function (Blueprint $table) 
        {
            $table->increments('id')->unsigned()->index();
            $table->integer('petition_id');
            $table->integer('user_id');
            $table->string('email_visibility');
            $table->string('comment');
            $table->tinyInteger('confirmed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('petition_signature');
    }
}
