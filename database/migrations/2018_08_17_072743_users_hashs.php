<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersHashs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users_hashs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->index('user_id');
            $table->string('device');
			$table->text('hash');
			$table->dateTime('last_use');
			$table->boolean('active');
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
         Schema::dropIfExists('users_hashs');
    }
}
