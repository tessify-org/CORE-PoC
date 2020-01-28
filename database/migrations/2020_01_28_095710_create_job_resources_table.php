<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('job_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_url');
            $table->string('file_size');
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
        Schema::dropIfExists('job_resources');
    }
}
