<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function studentExams()
    {
        return $this->hasMany(StudentExam::class);
    }
}
