<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_men', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->string('birthdate');
            $table->string('toolBackLicenceImage');
            $table->string('toolFrontLicenceImage');
            $table->unsignedBigInteger('toolType_id');
            $table->string('nationalityFrontIdImage');
            $table->string('nationalityBackIdImage');
            $table->string('profileImage');
            $table->unsignedBigInteger('state_id');
            $table->boolean('active');
            $table->boolean('working');
            $table->integer('type');
            $table->double('lat');
            $table->double('long');
            $table->double('wallet');
            $table->timestamps();

            $table->foreign('toolType_id')->references('id')->on('tool_types')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('state_id')->references('id')->on('states')
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
        Schema::dropIfExists('delivery_men');
    }
}
