<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreColumn extends Model
{
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
