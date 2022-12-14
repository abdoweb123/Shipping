<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id');
            $table->string('phone');
            $table->string('profile_image');
            $table->string('full_name');
            $table->unsignedBigInteger('nationality_id');
            $table->integer('gender');
            $table->date('birthDate');
            $table->string('email');
            $table->string('id_number');
            $table->string('identity_image');
            $table->string('relative_phone');
            $table->unsignedBigInteger('city_id');
            $table->string('area');
            $table->unsignedBigInteger('workingArea_id');  // cities table
            $table->unsignedBigInteger('specialty_id');
            $table->boolean('health_insurance');
            $table->boolean('antecedents');
            $table->unsignedBigInteger('reachedUs_id');
            $table->string('arabic_video_url');
            $table->string('english_video_url')->nullable();
            $table->boolean('active');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('nationality_id')->references('id')->on('nationalities')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('workingArea_id')->references('id')->on('cities')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('reachedUs_id')->references('id')->on('reached_us')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('specialty_id')->references('id')->on('specialties')
                ->onDelete('cascade')->onUpdate('cascade');

        });
    }





    public function down()
    {
        Schema::dropIfExists('users');
    }
}
