<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageRedir extends Model
{
    protected $fillable = [
        'url_type',
        'old_url',
        'new_url',
        'status_code',
    ];
}
