<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    public $timestamps = false;
    protected $fillable = ['score_column_id', 'student_id', 'score'];
}
