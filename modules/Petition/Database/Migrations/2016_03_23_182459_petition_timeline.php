<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PetitionTimeline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('petition_timeline', function (Blueprint $table) 
        {
            $table->increments('id')->unsigned()->index();
            $table->integer('user_id');
            $table->integer('petition_id');
            $table->string('title');
            $table->string('content');
            $table->string('link')->default('#');
            $table->tinyInteger('approved')->default(0);
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
        Schema::drop('petition_timeline');
    }
}
