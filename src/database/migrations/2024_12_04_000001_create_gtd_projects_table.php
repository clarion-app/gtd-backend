<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGtdProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('gtd_projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->uuid('parent_project_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_project_id')->references('id')->on('gtd_projects');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gtd_projects');
    }
}
