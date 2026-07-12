<div class="card blog-card h-100 shadow-sm border-0">


                <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center gap-2">
                        @if($blog->published == false)
                            <span class="badge bg-secondary text-white">Draft</span>
                        @endif
                        <h5 class="card-title mb-0 {{ $blog->published ? '' : 'text-muted' }}" style="font-size: 1.1rem; font-weight: 600;">
                            {{ $blog->title }}
                        </h5>
                    </div>
                    <a target="_blank" class="btn btn-sm btn-link text-secondary p-0" href="{{ $blog->blog_url }}" title="View Blog">
                        <span class="fa fa-external-link-alt"></span>
                    </a>
                </div>


                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            @if($blog->image)
                                <a href="{{ url('storage/app/public/' . $blog->image) }}" class="d-block ratio ratio-4x3 ov-hidden" target="_blank">
                                    {!! $blog->blogMedia() !!}
                                </a>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded border w-100" style="height: 90px;">
                                    <span class="text-muted small"><span class="fa fa-image d-block text-center mb-1"></span> No Image</span>
                                </div>
                            @endif
                            <div class="mt-2">
                                <span class="badge bg-primary text-light rounded-pill px-3">
                                    {{ $blog->blog_type }}
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-8 d-flex flex-column justify-content-between">
                            <p class="text-secondary small mb-3">
                                {{ Str::limit( preg_replace('/\s+/u', ' ',($blog->excerpt)), 80) }}
                            </p>

                            <div class="text-muted small border-top pt-2">
                                <div class="d-flex justify-content-between mb-1">
                                    <span><span class="fa fa-user text-primary me-1"></span> {{ $blog->author_data->author_name ?? $blog->author }}</span>
                                    <span><span class="fa fa-calendar-alt me-1"></span> {{ $blog->publish_date }}</span>
                                </div>

                                <div class="d-flex justify-content-between x-small text-opacity-75" style="font-size: 0.75rem;" title="Last updated by {{ $blog->updated_by_data->author_name ?? 'N/A' }}">
                                    <span><span class="fa fa-user-edit me-1"></span> {{ Str::limit($blog->updated_by_data->author_name ?? 'N/A', 15) }}</span>
                                    <span><span class="fa fa-history me-1"></span> {{ $blog->updated_at->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center pb-3">
                    <div>
                        <span class="badge bg-info text-dark rounded-pill px-3">
                            {{ $blog->category }}
                        </span>
                        <a href="{{ route('admin.blog-faqs.index', $blog->id) }}" class="badge  bg-warning" data-toggle="tooltip" title="Blog ID: {{ $blog->id }}">
                            <span class="fa fa-question"></span> faqs {!! $blog->faqs_count()?' ('.$blog->faqs_count().')':'' !!}
                        </a>
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        <button class="btn btn-light btn-sm text-info copy-url-btn border" data-clipboard-text="{{ url('blogs/'.$blog->slug) }}" title="Copy Link">
                            <span class="fa fa-copy"></span>
                        </button>

                        <div class="dropdown d-inline-block">
                            <button class="btn btn-light btn-sm border text-secondary dropdown-toggle" type="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Share Blog">
                                <span class="fa fa-share-alt"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-primary" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url("blog/{$blog->slug}")) }}" target="_blank">
                                        <span class="fab fa-facebook me-2"></span> Facebook
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-dark" href="https://x.com/intent/tweet?url={{ urlencode(url('blog/'.$blog->slug)) }}&text={{ urlencode($blog->title) }}" target="_blank">
                                        <span class="fab fa-twitter me-2"></span> X (Twitter)
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-primary" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url('blog/'.$blog->slug)) }}" target="_blank">
                                        <span class="fab fa-linkedin-in me-2"></span> LinkedIn
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block m-0">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group">
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-light btn-sm text-warning border">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <button type="submit" class="btn btn-light btn-sm text-danger border" onclick="return confirm('Are you sure?')">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
