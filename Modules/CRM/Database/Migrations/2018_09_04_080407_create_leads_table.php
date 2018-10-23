<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(); //Responsible
            $table->integer('client_id')->nullable(); //Client
            $table->integer('order_id')->nullable(); //Order
            $table->integer('status_id')->nullable(); // Status
            $table->string('name')->nullable(); // Name of lead
            $table->boolean('active')->default(1); // Name of lead
            $table->string('source')->nullable(); // Name of lead
            $table->text('description')->nullable(); // Description

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
        Schema::dropIfExists('leads');
    }
}