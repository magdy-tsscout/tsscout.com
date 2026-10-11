<?php

namespace App\Observers;

use App\Models\tool;

class ToolObserver
{
    function updating(tool $tool) {
        $originalTool = tool::find($tool->id);
        $request = request()->all();

        if ($originalTool->slug !== $tool->slug) {
            \App\Models\PageRedir::create([
                'old_url' => "/product-scouting/{$originalTool->slug}",
                'new_url' => "/product-scouting/{$request['slug']}",
                'status_code' => 301,
                'url_type'=> 'relative'
            ]);
        }
    }
}
