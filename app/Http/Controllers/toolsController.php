<?php

namespace App\Http\Controllers;

use App\Models\tool;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class toolsController extends Controller
{

    private function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin; // Ensure user is authenticated and is an admin
    }

    // Method to show all tools in the index page for the admin
    public function index()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        // Fetch all tools from the database
        $tools = tool::all();

        // Pass tools data to the index view
        return view('tools.index', compact('tools'));
    }

    public function show($slug)
    {
        // Fetch the page using the slug
        $page = tool::where('slug', $slug)->firstOrFail();

        $Faq = Faq::where('category_name', 'Tool-Features')
        ->where('tool_slug', $slug)
        ->get();  // Fetch all matching FAQs

        dd($page->sections());

        // Pass the page data to the view
        return view('tool', compact('page','Faq'));
    }

    public function create()
    {
        return view('tools.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_author' => 'nullable|string',
            'slug' => 'required|string|unique:tools,slug',
            'content_header' => 'nullable|string',
            'content_subheader' => 'nullable|string',
            'header_1' => 'required|string|max:255',
            'paragraph_1' => 'required|string',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
            'header_2' => 'nullable|string|max:255',
            'paragraph_2' => 'nullable|string',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_3' => 'nullable|string|max:255',
            'paragraph_3' => 'nullable|string',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_4' => 'nullable|string|max:255',
            'paragraph_4' => 'nullable|string',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file uploads
        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image_'.$i)) {

                // Get the original filename with extension
                $originalFileName = $request->file('image_'.$i)->getClientOriginalName();

                // Generate a unique filename to avoid conflicts
                $filename = pathinfo($originalFileName, PATHINFO_FILENAME);
                $extension = $request->file('image_'.$i)->getClientOriginalExtension();
                $uniqueFileName = $filename . '_' . time() . '.' . $extension;

                // Store the image in the public storage
                $path = $request->file('image_'.$i)->storeAs('images', $uniqueFileName, 'public');

                // Save the path or file name in the database
                $data['image_'.$i] = $path;
            }
        }


        tool::create($data);

        return redirect()->route('tools.create')->with('success', 'Page created successfully');
    }



  // Edit method
public function edit(tool $tool)
{
    return view('tools.edit', compact('tool'));  // Note: Use $tool instead of $page
}

// Update method
public function update(Request $request, tool $tool)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
        'meta_author' => 'nullable|string',
        'slug' => 'required|string|unique:tools,slug,' . $tool->id,
        'content_header' => 'nullable|string',
        'content_subheader' => 'nullable|string',
        'header_1' => 'required|string|max:255',
        'paragraph_1' => 'required|string',
        'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'header_2' => 'nullable|string|max:255',
        'paragraph_2' => 'nullable|string',
        'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'header_3' => 'nullable|string|max:255',
        'paragraph_3' => 'nullable|string',
        'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'header_4' => 'nullable|string|max:255',
        'paragraph_4' => 'nullable|string',
        'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle file uploads
    for ($i = 1; $i <= 4; $i++) {
        if ($request->hasFile('image_'.$i)) {

            // Get the original filename with extension
            $originalFileName = $request->file('image_'.$i)->getClientOriginalName();

            // Generate a unique filename to avoid conflicts
            $filename = pathinfo($originalFileName, PATHINFO_FILENAME);
            $extension = $request->file('image_'.$i)->getClientOriginalExtension();
            $uniqueFileName = $filename . '_' . time() . '.' . $extension;

            // Store the image in the public storage
            $path = $request->file('image_'.$i)->storeAs('images', $uniqueFileName, 'public');

            // Save the path or file name in the database
            $data['image_'.$i] = $path;
        }
    }


    $tool->update($data);

    return redirect()->route('tools.edit', $tool->id)->with('success', 'Page updated successfully');
}

     public function destroy(Tool $tool)
    {
      // Delete the tool
      $tool->delete();

       // Redirect to the index page with success message
      return redirect()->route('tools.index')->with('success', 'Tool deleted successfully');
    }





}
