<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Faq;
use App\Models\Page;
use App\Models\PageBackup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class PageBackupController extends Controller
{
    function index($view_name) {
        $page= Page::where('view_name',$view_name)->first();
        $backups= PageBackup::where('view_name',$view_name)->get();
        if( ! $page ) abort(404, 'No backups for this view');
        return view('pages-backup.index',compact('page','backups'));
    }

    function preview($view_name, $id,$base) {
        $page= Page::where('view_name',$view_name)->first();
        $backup= PageBackup::where('id',$id)->first();
        if( ! $page || ! $backup ) abort(404, 'No backups for this view');
        if($base== 'from') $content= $backup->from_content;
        if($base== 'to') $content= $backup->to_content;

        if($base == 'from' || $base == 'to' ) {
            return Blade::render($content, ['page'=>$page, 'blogs'=>Blog::all(), 'faqs'=>Faq::all()]);
        }elseif( $base== 'side-by-side' ) {
               // return view('pages-backup.preview-side-by-side', compact('page','backup'));
        }
    }

    function restore($view_name, $id,$base) {
        $page= Page::where('view_name',$view_name)->first();
        $backup= PageBackup::where('id',$id)->first();
        if( ! $page || ! $backup ) abort(404, 'No backups for this view');
        if($base== 'from') $content= $backup->from_content;
        if($base== 'to') $content= $backup->to_content;
        // dd($content);
        file_put_contents(base_path("resources/views/{$view_name}.blade.php"), $content);
        return redirect()->route('admin.pages.backup.index', $view_name)->with('success', 'Page restored from backup');
    }
}
