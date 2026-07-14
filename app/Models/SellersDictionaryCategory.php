<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SellersDictionaryCategory extends Model
{
    protected $fillable = ['name', 'slug', 'image'];

    protected static function booted(): void
    {
        static::saving(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function entries()
    {
        return $this->hasMany(SellersDictionary::class, 'category_id');
    }

    public function imageUrl()
    {
        return $this->image ? asset('storage/' . $this->image) : 'https://tsscout.com/public/images/logo.svg';
    }

}
