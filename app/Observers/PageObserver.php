<?php

namespace App\Observers;

class PageObserver
{
    public function updating(\App\Models\Page $page) {
        $originalPage = \App\Models\Page::find($page->id);
        $request = request()->all();

        if ($originalPage->slug !== $page->slug) {
            \App\Models\PageRedir::create([
                'old_url' => "/{$originalPage->slug}",
                'new_url' => "/{$request['slug']}",
                'status_code' => 301,
                'url_type'=> 'relative'
            ]);
        }
    }
}
