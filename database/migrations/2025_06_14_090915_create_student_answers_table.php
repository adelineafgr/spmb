<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_student_answers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_exam_id')->constrained('student_exams')->onDelete('cascade'); // Terkait dengan sesi ujian siswa
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Soal mana
            $table->foreignId('answer_id')->nullable()->constrained()->onDelete('set null'); // Pilihan jawaban siswa
            $table->timestamps();

            $table->unique(['student_exam_id', 'question_id']); // Satu siswa hanya bisa menjawab satu soal sekali per ujian
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
