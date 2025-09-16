<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان الكورس
            $table->text('description'); // وصف الكورس
            $table->date('start_date'); // تاريخ بداية الكورس
            $table->integer('max_students'); // عدد الطلاب المسموح
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade'); // ربط بالمدرب
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
