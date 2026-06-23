<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorData extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'author_name',
        'author_card',
        'author_slug',
        'author_img',
    ];


}
