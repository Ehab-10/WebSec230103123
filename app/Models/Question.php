<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_text', 'option1', 'option2', 'option3', 'option4', 'correct_option',
    ];
}

