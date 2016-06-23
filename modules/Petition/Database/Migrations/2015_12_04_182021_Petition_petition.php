<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PetitionPetition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('petition_petition', function (Blueprint $table) 
        {
            $table->increments('id')->unsigned()->index();
            $table->integer('user_id');
            $table->string('title');
            $table->string('declaration');
            $table->string('slug');
            $table->string('sender');
            $table->string('receiver');
            $table->string('tags');
            $table->string('url');
            $table->integer('category_id');
            $table->string('press');
            $table->string('titulo_eleitor');
            $table->string('address');
            $table->string('image');
            $table->integer('goal')->default(0);
            $table->tinyInteger('allow_comments')->default(1);
            $table->string('comment');
            $table->integer('migrated');
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
         Schema::drop('petition_petition');
    }
}
