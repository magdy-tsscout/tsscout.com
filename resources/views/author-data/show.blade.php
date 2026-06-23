@extends("layouts.master")
@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <img src="{{ $authorData?->author_img ? asset('images/'.$authorData->author_img) : asset('images/icon-client.svg') }}" alt="{{ $authorData->author_name }}" class="img-fluid rounded">
                </div>
                <div class="col-lg-9">

                    <h4>{{ $authorData->author_name }}</h4>
                    <p>{!! nl2br($authorData->author_card) !!}</p>

                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
                @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6 d-flex blog-item-container" data-category="{{ $blog->category }}">
                    <div class="blog-item w-100">
                        <div class="post-featured-image">
                            <figure class="image-anime">
                                {{-- @if ($blog->video_url)
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ \Str::after($blog->video_url, 'v=') }}" frameborder="0" allowfullscreen></iframe>
                                @else --}}
                                    <a href="{{ route('blogs.show', $blog->slug) }}">
                                        <img src="{{ 'https://tsscout.com/storage/app/public/' .$blog->image }}" alt="{{ $blog->title }}">
                                    </a>
                                {{-- @endif --}}
                            </figure>
                        </div>

                        <div class="post-item-body">
                            <p><a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->publish_date }}</a></p>
                            <h3><a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                            @php
                                $content = json_decode($blog->content, true);
                            @endphp
                            <div class="content-sections">
                                @if($content && is_array($content))
                                    @foreach($content as $section)
                                        @if(isset($section['heading']))
                                            <h4>{{ $section['heading'] }}</h4>
                                        @endif
                                        @if(isset($section['paragraphs']) && is_array($section['paragraphs']))
                                            @foreach($section['paragraphs'] as $paragraph)
                                                <p>{{ Str::limit($paragraph, 150) }}</p>
                                            @endforeach
                                        @endif
                                        @if(isset($section['image']))
                                            <figure class="image-anime">
                                                <img src="{{ asset($section['image']) }}" alt="">
                                            </figure>
                                        @endif
                                    @endforeach
                                @else
                                    <p>{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- Category Label -->
                        <div class="category-label">
                            {{ $blog->category=='Tiktook'?'TikTok Shop':$blog->category }}
                        </div>
                    </div>
                </div>
            @endforeach

			</div>
</div>
@endsection
