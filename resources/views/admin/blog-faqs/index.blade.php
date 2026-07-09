@extends('layouts.app')

@section('title', 'Blog FAQs')

@section('content')
<div class="container mt-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h4 mb-0">Blog FAQs ({{ $blog->title }})</h1>
		<a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary btn-sm">Back to Blogs</a>
	</div>

	@if (session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
	@endif

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul class="mb-0 pl-3">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="card mb-4">
		<div class="card-header bg-primary text-white">Add New FAQ</div>
		<div class="card-body">
			<form action="{{ route('admin.blog-faqs.store', $blog_id) }}" method="POST">
				@csrf
				<div class="form-group">
					<label for="title">Question</label>
					<input
						id="title"
						type="text"
						name="title"
						class="form-control"
						value="{{ old('title') }}"
						placeholder="Enter question title"
					>
				</div>

				<div class="form-group mt-3">
					<label for="content">Answer</label>
					<textarea
						id="content"
						name="content"
						rows="4"
						class="form-control"
						placeholder="Enter answer content"
					>{{ old('content') }}</textarea>
				</div>

				<button type="submit" class="btn btn-success mt-3">Save FAQ</button>
			</form>
		</div>
	</div>

	<div class="card">
		<div class="card-header text-white bg-secondary">Existing FAQs</div>
		<div class="card-body p-0">
			@if ($faqs->isEmpty())
				<p class="text-muted p-3 mb-0">No FAQs found for this blog yet.</p>
			@else
                <form action="{{ route('admin.blog-faqs.update', $blog_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">#</th>
                                    <th style="width: 70px;">Delete</th>
                                    <th>Question</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <label class="form-check-label"
                                                    for="del_{{ $faq->id }}"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        name="delete_ids[]"
                                                        id="del_{{ $faq->id }}"
                                                        value="{{ $faq->id }}"
                                                        class="form-check-input"
                                                    >
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="title[]" class="form-control form-control-sm mb-1" value="{{ $faq->title }}" required>

                                            <textarea name="content[]" rows="2" class="form-control form-control-sm" style="height: 150px;" required>{{ $faq->content }}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button name="update" type="submit" class="btn btn-primary btn-sm" value="update">
                                                    <span class="fa fa-save"></span>
                                                    Save Changes
                                                </button>
                                            </div>
                                            <div class="col-lg-6 text-right">
                                                <button name="delete" onclick="return confirm('حذف ؟')" type="submit" class="btn btn-danger btn-sm" value="delete">
                                                    <span class="fa fa-trash"></span>
                                                    Delete Selected
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </form>
			@endif
		</div>
	</div>
</div>
@endsection
