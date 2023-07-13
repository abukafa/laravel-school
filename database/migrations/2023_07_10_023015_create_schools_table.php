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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->integer('npsn')->nullable();
            $table->string('organization')->nullable();
            $table->string('permit')->nullable();
            $table->string('address')->nullable();
            $table->string('map')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('motto')->nullable();
            $table->string('period')->nullable();
            $table->string('head')->nullable();
            $table->string('contact')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
        DB::table('schools')->insert([
            'name' => 'Nama Sekolah mu'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
};
