<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('specialization_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('duration_by_day');
            $table->double('minimum_cost');
            $table->double('maximum_cost');
            $table->integer('payment_type'); // بالمهمة \ باليوم
            $table->integer('job_type');        // 1=> part time 2=> full time
            $table->text('job_description');
            $table->date('start_time');
            $table->date('end_time');
            $table->boolean('started')->default(false);
            $table->boolean('finished')->default(false);
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('specialization_id')->references('id')->on('specialties')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }





    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
