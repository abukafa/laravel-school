<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->string('project_name');
            $table->foreignId('student_id')->constrained('students');
            $table->string('student_name');
            $table->integer('semester');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->date('date');
            $table->date('deadline');
            $table->enum('status', ['Not Started', 'In Progress', 'Completed', 'On Hold', 'Cancelled']);
            $table->text('link')->nullable();
            $table->tinyInteger('accepted')->default(0);
            $table->text('review')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('teacher_name')->nullable();
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
};
