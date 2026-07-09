<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogFaq extends Model
{
    protected $fillable = [
        'title',
        'content',
        'blog_id',
    ];


}
