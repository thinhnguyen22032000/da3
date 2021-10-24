<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;

class Question extends Model
{
    use HasFactory;

    protected $table = 'question';

    protected $fillable = ['id_question', 'id_lesson', 'content'];

    

    
}
