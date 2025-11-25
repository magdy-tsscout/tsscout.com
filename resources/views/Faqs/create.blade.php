@extends('layouts.app')

@section('title', 'Add New FAQ')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h1>Add New FAQ</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.faqs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <input type="text" class="form-control" id="question" name="question" required>
                </div>
                <div class="mb-3">
                    <label for="answer" class="form-label">Answer</label>
                    <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category</label>
                    <select class="form-control" id="category_name" name="category_name" required>
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- This select menu will be shown only if 'Tool-Features' is selected -->
<div class="mb-3" id="tool_slug_wrapper" style="display: none;">
    <label for="tool_slug" class="form-label">Tool Slug</label>
    <select class="form-control" id="tool_slug" name="tool_slug">
        <option value="">Select a Tool</option>
        @foreach($tools as $tool)
            <option value="{{ $tool->slug }}">{{ $tool->slug }}</option> <!-- Assuming 'name' and 'slug' fields exist in tools table -->
        @endforeach
    </select>
</div>
                <div class="mb-3">
                    <label for="section_title" class="form-label">Section Title</label>
                    <input type="text" class="form-control" id="section_title" name="section_title" placeholder="e.g., General Questions">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
     <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_name');
        const toolSlugWrapper = document.getElementById('tool_slug_wrapper');
        
        // Listen for changes on the category select menu
        categorySelect.addEventListener('change', function() {
            // Check if 'Tool-Features' is selected
            if (this.value === 'Tool-Features') {
                toolSlugWrapper.style.display = 'block'; // Show the tool slug select
            } else {
                toolSlugWrapper.style.display = 'none'; // Hide the tool slug select
            }
        });
    });
</script>

 @endsection
