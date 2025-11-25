<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
// In your Page model
protected $fillable = [
    'title', 'slug', 'content', 'meta_description', 'meta_keywords', 'meta_author', 'view_name'
];


    
}
