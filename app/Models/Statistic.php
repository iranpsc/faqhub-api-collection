<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statistics';

    protected $guarded = [];

    public static function getValueByKey($key)
    {
        return self::where('key', $key)->first()->value;
    }
}
