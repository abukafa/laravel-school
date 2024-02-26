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
        Schema::create('competences', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->string('subject');
            $table->string('semester');
            $table->integer('teacher_id');
            $table->string('teacher');
            $table->text('competence_1')->nullable();
            $table->text('competence_2')->nullable();
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
        Schema::dropIfExists('competences');
    }
};
