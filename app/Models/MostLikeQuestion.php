<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MostLikeQuestion extends Model
{
    protected $fillable = [
        'question_id',
        'title',
        'slug',
        'category_name',
        'user_name',
        'created_at'
    ];
    public $timestamps = false;
}
