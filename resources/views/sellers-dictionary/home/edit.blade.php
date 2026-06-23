@extends("layouts.app")

@section('content')
    <div class="container">
        <h1>Edit Sellers Dictionary Home</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.sellers-dictionary.web.update') }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $sellersDictionaryHome->title }}">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" rows="5">{{ $sellersDictionaryHome->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <x-editor-scripts />
@endsection
