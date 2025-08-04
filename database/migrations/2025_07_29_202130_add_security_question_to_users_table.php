<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'security_question')) {
            $table->string('security_question')->nullable();
        }

        if (!Schema::hasColumn('users', 'security_answer')) {
            $table->string('security_answer')->nullable();
        }
    });
}


public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['security_question', 'security_answer']);
    });
}
};
