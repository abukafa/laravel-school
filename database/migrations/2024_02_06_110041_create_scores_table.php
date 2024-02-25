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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('serial');
            $table->integer('student_id');
            $table->string('student');
            $table->integer('registered');
            $table->integer('semester');
            $table->integer('competence_id');
            $table->integer('subject');
            $table->integer('month_1')->nullable();
            $table->integer('month_2')->nullable();
            $table->integer('month_3')->nullable();
            $table->integer('month_4')->nullable();
            $table->integer('month_5')->nullable();
            $table->integer('month_6')->nullable();
            $table->tinyInteger('is_ok_1')->default(0);
            $table->text('competence_1')->nullable();
            $table->tinyInteger('is_ok_2')->default(0);
            $table->text('competence_2')->nullable();
            $table->tinyInteger('is_ok_3')->default(0);
            $table->text('competence_3')->nullable();
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
        Schema::dropIfExists('scores');
    }
};
