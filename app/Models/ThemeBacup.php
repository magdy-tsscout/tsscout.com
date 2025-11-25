<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeBacup extends Model
{
    protected $fillable = [
        'file_name',
        'content',
        'backup_type',
    ];
}
