<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('fromAddress')->nullable();
            $table->string('toAddress')->nullable();
            $table->double('fromLat')->nullable();
            $table->double('fromLong')->nullable();
            $table->double('toLat')->nullable();
            $table->double('toLong')->nullable();
            $table->unsignedBigInteger('stateFrom_id');
            $table->unsignedBigInteger('stateTo_id');
            $table->unsignedBigInteger('deliveryMan_id')->nullable();
            $table->string('description');
            $table->double('price');
            $table->double('expectedPrice');
            $table->integer('type');
            $table->string('images');
            $table->boolean('declined')->default(false);
            $table->boolean('accepted')->default(false);
            $table->boolean('picked')->default(false);
            $table->boolean('dropped')->default(false);
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('stateFrom_id')->references('id')->on('states')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('stateTo_id')->references('id')->on('states')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('deliveryMan_id')->references('id')->on('delivery_men')
                ->onDelete('cascade')->onUpdate('cascade');
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
