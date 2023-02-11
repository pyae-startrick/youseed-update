<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebinarsQuiz extends Model
{
    protected $guarded = [];

    public function quizResults()
    {
        return $this->hasMany('App\Models\QuizzesResult', 'quiz_id', 'quiz_id');
    }
}
