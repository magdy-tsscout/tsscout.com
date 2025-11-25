<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'slug',
        'content_header',
        'content_subheader',
        'header_1',
        'paragraph_1',
        'image_1',
        'header_2',
        'paragraph_2',
        'image_2',
        'header_3',
        'paragraph_3',
        'image_3',
        'header_4',
        'paragraph_4',
        'image_4'
    ];
}
