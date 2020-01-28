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
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('job_status_id');
            $table->unsignedInteger('job_category_id');
            $table->unsignedInteger('work_method_id');
            $table->string('slug');
            $table->string('title');
            $table->string('slogan')->nullable();
            $table->text('problem');
            $table->text('description')->nullable();
            $table->string('header_image_url')->default('storage/images/jobs/header/default.png');
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
