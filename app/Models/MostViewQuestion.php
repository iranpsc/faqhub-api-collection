<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MostViewQuestion extends Model
{
    protected $fillable = [
        'question_id',
        'title',
        'slug',
        'category_name',
        'views',
        'published_at'
    ];

    public $timestamps = false;
}
