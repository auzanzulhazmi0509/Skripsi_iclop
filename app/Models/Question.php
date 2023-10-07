<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';

    protected $fillable = [
        'title',
        'topic',
        'dbname',
        'description',
        'answer',
        'hint',
        'description',
        'hint',
        'answer',
        // 'test_result',
        'guide'
    ];
}
