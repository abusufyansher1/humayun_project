<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['std_id', 'c_exam_id', 'obt_marks'];  
    use HasFactory;
}
