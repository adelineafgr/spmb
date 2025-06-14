<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_exams_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 'TKD', 'TPA', 'Minat Bakat'
            $table->text('description')->nullable();
            $table->integer('duration_minutes')->nullable(); // Durasi total ujian
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};