<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFb extends Migration {

    public function up()
    {
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('userid')->unique();
            $table->string('name');            
            $table->string('remember_token');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('users');
    }

}
