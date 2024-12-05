<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGtdActionsTable extends Migration
{
    public function up()
    {
        Schema::create('gtd_actions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->uuid('project_id')->nullable();
            $table->uuid('context_id')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_id')->references('id')->on('gtd_projects');
            $table->foreign('context_id')->references('id')->on('gtd_contexts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gtd_actions');
    }
}
