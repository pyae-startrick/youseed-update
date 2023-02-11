<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignStudentToTeacher extends Model
{
    protected $guarded = ['id'];

    public function teacher()
    {
        return $this->hasMany('App\User', 'teacher_id');
    }
}
