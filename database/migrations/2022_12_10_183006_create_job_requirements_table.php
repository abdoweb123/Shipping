<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('company_id');
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }




    public function down()
    {
        Schema::dropIfExists('job_requirements');
    }
}
