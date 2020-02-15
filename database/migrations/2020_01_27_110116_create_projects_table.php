<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('project_status_id');
            $table->unsignedInteger('project_category_id');
            $table->unsignedInteger('work_method_id');
            $table->string('slug');
            $table->string('title');
            $table->string('slogan')->nullable();
            $table->text('description')->nullable();
            $table->string('header_image_url')->default('storage/images/projects/header/default.png');
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
        Schema::dropIfExists('projects');
    }
}
