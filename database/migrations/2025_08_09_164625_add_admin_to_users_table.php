<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // إضافة عمود admin كـ boolean (صحيح/خطأ) أو integer حسب استخدامك
            // مثلاً 0=مستخدم عادي، 1=أدمن
            $table->boolean('admin')->default(0)->after('password');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin');
        });
    }
}
