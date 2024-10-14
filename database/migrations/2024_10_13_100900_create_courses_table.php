<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("courses", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("subject");
            $table->string("note");
            $table->string("author");
            $table->string("title");
            $table->string("section");
            $table->text("description")->nullable();
            $table->string("video_url")->nullable();
            $table->string("video_duration")->default(00.0);
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
        Schema::dropIfExists("courses");
    }
};
