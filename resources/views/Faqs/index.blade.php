@extends('layouts.app')

@section('title', 'FAQs')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h1>FAQs</h1>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-success">Create FAQ</a>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionFAQs">
                @foreach ($faqs as $faq)
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="heading{{ $faq->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse show"
                            aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionFAQs">
                            <div class="accordion-body">
                                <p>{{ $faq->answer }}</p>
                                <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
