<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferedTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offered_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jobTask_id');
            $table->unsignedBigInteger('offer_id');
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('jobTask_id')->references('id')->on('job_tasks')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('offer_id')->references('id')->on('offers')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }



    public function down()
    {
        Schema::dropIfExists('offered_tasks');
    }
}
