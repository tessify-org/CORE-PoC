<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('ministry_id')->nullable();
            $table->unsignedInteger('organization_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('job_title_id')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->date('started_at');
            $table->date('stopped_at')->nullable();
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
        Schema::dropIfExists('assignments');
    }
}
