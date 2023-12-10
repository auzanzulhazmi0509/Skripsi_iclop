<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class Submission extends Model
{
    protected $table = 'submissions';

    protected $fillable = [
        'student_id',
        'question_id',
        'status',
        'answer',
        'created_at',
        'updated_at',
    ];

    public function soal()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->addHours(7); // Menambahkan 7 jam untuk mengubah ke WIB
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->addHours(7); // Menambahkan 7 jam untuk mengubah ke WIB
    }
}
