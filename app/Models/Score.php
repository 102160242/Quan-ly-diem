<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = ['score_column_id', 'student_id', 'score'];
    public function scoreColumn()
    {
        return $this->belongsTo(ScoreColumn::class);
    }
}
