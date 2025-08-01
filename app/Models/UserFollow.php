<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id'
    ];
}
