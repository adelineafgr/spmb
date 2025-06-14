<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_student_exams_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            $table->timestamp('start_time')->nullable(); // Tetap nullable jika suatu saat mau pakai
            $table->timestamp('end_time')->nullable();   // Tetap nullable jika suatu saat mau pakai
            $table->integer('score')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'failed'])->default('pending');
            $table->timestamps();

            $table->unique(['student_id', 'exam_id']);
        });
    }

    // ...
};
