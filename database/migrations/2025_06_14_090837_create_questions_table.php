<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_questions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained()->onDelete('cascade'); // Soal ini milik ujian mana
            $table->foreignId('subject_id')->nullable()->constrained()->onDelete('set null'); // Untuk TKD, soal milik mapel mana
            $table->text('question_text');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};