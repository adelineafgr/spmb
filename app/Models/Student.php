<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'smp',
        'pilihan_jurusan_1',
        'pilihan_jurusan_2',
        'skor_jurusan_1',
        'skor_jurusan_2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function studentExams()
    {
        return $this->hasMany(StudentExam::class);
    }
}
