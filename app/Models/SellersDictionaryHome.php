<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellersDictionaryHome extends Model
{
    protected $table = 'sellers_dictionary_homes';

    protected $fillable = [
        'title',
        'content',
    ];
}
