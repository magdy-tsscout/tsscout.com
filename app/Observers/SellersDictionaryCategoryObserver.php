<?php

namespace App\Observers;

use App\Models\PageRedir;
use App\Models\SellersDictionaryCategory;

class SellersDictionaryCategoryObserver
{
    public function updating(SellersDictionaryCategory $category) {
        $request= request()->all();
        $originalCategory = SellersDictionaryCategory::find($category->id);
        if ($originalCategory->slug !== $category->slug) {
            PageRedir::create([
                'old_url' => "/sellers-dictionary/{$originalCategory->slug}",
                'new_url' => "/sellers-dictionary/{$request['slug']}",
                'status_code' => 301,
                'url_type'=> 'relative'
            ]);
        }
    }
}
