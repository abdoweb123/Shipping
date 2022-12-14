<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_phone');
            $table->unsignedBigInteger('city_id');
            $table->string('logo_image');
            $table->string('cover_image');
            $table->string('pre_fullName');
            $table->string('pre_email');
            $table->string('pre_image');
            $table->string('commercialRecord_image');
            $table->string('licence_image');
            $table->string('pre_agent_image');
            $table->string('national_address');
            $table->string('services');
            $table->string('jobs');
            $table->string('contract_image');
            $table->boolean('active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')->onUpdate('cascade');

        });
    }





    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
