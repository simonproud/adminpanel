<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCstmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_cstms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->boolean('require');
            $table->string('type');
            $table->string('permission');
            $table->mediumText('description');
            $table->boolean('active');
            $table->integer('order');
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
        Schema::dropIfExists('client_cstms');
    }
}
