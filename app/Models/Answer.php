<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected  $fillable = ['test_id', 'answer', 'points', 'active', 'question_id', 'user_id', 'course_id', 'position'];
}
