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
            $table->string('child_num')->nullable();
            $table->string('family_status')->nullable();
            $table->string('sibling_num')->nullable();
            $table->string('address')->nullable();
            $table->string('hamlet')->nullable();
            $table->string('village')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('hobby')->nullable();
            $table->string('sport')->nullable();
            $table->string('ambition')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('distance')->nullable();
            $table->string('time')->nullable();
            $table->string('father')->nullable();
            $table->string('father_birth_place')->nullable();
            $table->string('father_birth_date')->nullable();
            $table->string('father_education')->nullable();
            $table->string('father_note')->nullable();
            $table->string('mother')->nullable();
            $table->string('mother_birth_place')->nullable();
            $table->string('mother_birth_date')->nullable();
            $table->string('mother_education')->nullable();
            $table->string('mother_note')->nullable();
            $table->string('job')->nullable();
            $table->string('income')->nullable();
            $table->string('phone')->nullable();
            $table->string('guardian')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('illness')->nullable();
            $table->integer('performance')->unsigned()->nullable()->default(0);
            $table->string('photo')->nullable();
            $table->integer('graduation')->unsigned()->nullable()->default(0);
            $table->string('next_school')->nullable();
            $table->string('next_school_address')->nullable();
            $table->string('last_activity')->nullable();
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
