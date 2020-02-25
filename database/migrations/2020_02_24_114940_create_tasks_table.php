<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('task_status_id');
            $table->unsignedInteger('task_category_id');
            $table->unsignedInteger('task_seniority_id');
            $table->string('slug');
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('complexity')->default(1);
            $table->unsignedInteger('estimated_hours');
            $table->unsignedInteger('realized_hours')->default(0);
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
        Schema::dropIfExists('tasks');
    }
}
