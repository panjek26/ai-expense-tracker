<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->string('category')->after('description');
        });
    }

    public function down()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};