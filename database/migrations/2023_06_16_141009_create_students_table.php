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
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nis')->unsigned();
            $table->string('name');
            $table->string('nick_name');
            $table->string('gender');
            $table->string('rumble');
            $table->string('birth_place')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('hamlet')->nullable();
            $table->string('village')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('hobby')->nullable();
            $table->string('sport')->nullable();
            $table->string('ambition')->nullable();
            $table->string('father')->nullable();
            $table->string('father_birth')->nullable();
            $table->string('father_note')->nullable();
            $table->string('mother')->nullable();
            $table->string('mother_birth')->nullable();
            $table->string('mother_note')->nullable();
            $table->string('phone')->nullable();
            $table->string('job')->nullable();
            $table->string('income')->nullable();
            $table->string('image')->nullable();
            $table->string('payment_category')->nullable();
            $table->integer('graduation')->unsigned()->nullable()->default(0);
            $table->string('next_school')->nullable();
            $table->string('next_school_address')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('students');
    }
};
