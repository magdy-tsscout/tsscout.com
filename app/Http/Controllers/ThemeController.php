<?php

namespace App\Http\Controllers;

use App\Models\ThemeBacup;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $themes= scandir( resource_path('views/layouts') );
        for ($key = 0; $key < count($themes); $key++) {
            if (in_array($themes[$key], ['.','..','app.blade.php','auth.blade.php'])) {
                unset($themes[$key]);
            }
        }
        $themes = array_values($themes); // Reindex array to fix undefined array key error
        for ($key = 0; $key < count($themes); $key++) {
            $themes[$key]= str_replace('.blade.php','',$themes[$key]);

        }
        return view('themes.index', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function restore($file, $id)
    {
        if( $file== 'header' || $file== 'footer' ) {
            $file= "../{$file}";
        }
        $backup= ThemeBacup::where('id',$id)->first();
        if( ! $backup ) abort(404, 'No backups for this file');
        file_put_contents( resource_path("views/layouts/{$file}.blade.php"), $backup->content);
        return redirect()->route('admin.themes.index')->with('success', 'Theme file restored from backup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $file)
    {
        if( $file== 'header' || $file== 'footer' ) {
            $file= "../{$file}";
        }
        $content= htmlspecialchars_decode($request->content);
        $backup = new ThemeBacup();
        $backup->file_name = $file;
        $backup->content = file_get_contents( resource_path("views/layouts/{$file}.blade.php") );
        $backup->backup_type = 'theme';
        $backup->save();
        file_put_contents( resource_path("views/layouts/{$file}.blade.php"), $content);
        return redirect()->route('admin.themes.index')->with('success', 'Theme file saved successfully');
    }

    public function history($file)
    {
        if( $file== 'header' || $file== 'footer' ) {
            $file= "../{$file}";
        }
        $backups = ThemeBacup::where('file_name', $file)
            ->where('backup_type', 'theme')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('themes.history', compact('file', 'backups'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $file)
    {
        if( $file== 'header' || $file== 'footer' ) {
            $file= "../{$file}";
        }
        $content= file_get_contents( resource_path("views/layouts/{$file}.blade.php"));
        // return $content;
        return view('themes.edit', compact('file','content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
