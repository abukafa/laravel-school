<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::table('students', function (Blueprint $table) {
            $table->text('role')->after('ambition')->nullable();
            $table->text('skills')->after('role')->nullable();
            $table->string('own_phone')->after('skills')->nullable();
            $table->string('email')->after('own_phone')->nullable();
            $table->string('password')->after('email')->default(Hash::make('ciamis'));
            $table->string('instagram')->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
