<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissions';

    protected $fillable = [
        'student_id',
        'question_id',
        'status',
        'answer'
    ];

    public function soal()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}