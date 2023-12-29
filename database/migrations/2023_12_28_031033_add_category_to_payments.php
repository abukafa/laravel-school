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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('category')->after('name');
            $table->tinyInteger('is_once')->after('amount')->nullable()->default(0);
            $table->tinyInteger('is_monthly')->after('is_once')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('payment_category');
            $table->dropColumn('is_once');
            $table->dropColumn('is_monthly');
        });
    }
};
