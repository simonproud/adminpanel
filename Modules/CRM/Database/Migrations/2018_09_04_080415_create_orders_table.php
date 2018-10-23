<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // Name of order
            $table->string('cost'); // Cost of order
            $table->string('currency'); // Currency of order
            $table->string('status_id'); // Status of order
            $table->string('client_id'); // Client
            $table->string('description'); //description
            $table->boolean('active'); //description
            $table->string('user_id'); //responsible

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
        Schema::dropIfExists('orders');
    }
}
