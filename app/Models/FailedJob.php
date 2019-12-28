<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    public static function getJobs()
    {
        $list = FailedJob::select('exception', 'failed_at')->orderBy("id", "DESC")->limit(10)->get()->toArray();
        for($i = 0; $i < count($list); $i++)
        {
            $t = explode("\nStack trace", $list[$i]["exception"]);
            $list[$i]["exception"] = $t[0];
        }
        return $list;
    }
}
