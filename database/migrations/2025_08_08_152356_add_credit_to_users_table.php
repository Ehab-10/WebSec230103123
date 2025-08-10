<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('credit', 8, 2)->default(0);
            $table->string('role')->default('customer'); 
        });
    }
    
public function down()
{
    if (Schema::hasColumn('users', 'credit')) {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('credit');
        });
    }
}

    
};
