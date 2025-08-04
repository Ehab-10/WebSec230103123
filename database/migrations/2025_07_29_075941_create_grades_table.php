<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('grades', function (Blueprint $table) {
        $table->id();
        $table->string('subject');
        $table->integer('term');
        $table->integer('credit_hours');
        $table->decimal('grade_point', 3, 2); // مثال: 4.00 أو 3.75
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
