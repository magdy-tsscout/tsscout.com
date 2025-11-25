<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageBackup extends Model
{
    protected $fillable= [
        'view_name',
        'from_content',
        'to_content'
    ];
}
