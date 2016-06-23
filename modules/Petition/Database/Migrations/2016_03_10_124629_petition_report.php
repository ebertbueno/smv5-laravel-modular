<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PetitionReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('petition_report', function (Blueprint $table) 
        {
            $table->increments('id')->unsigned()->index();
            $table->integer('petition_id');
            $table->integer('why_id');
            $table->string('why_desc');
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
        //
        Schema::drop('petition_report');
    }
}
