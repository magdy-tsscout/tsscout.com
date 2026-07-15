@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
    body {
        background-color: #f3f4f6;
        background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .dashboard-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Stat Cards Specifics */
    .stat-card {
        position: relative;
        overflow: hidden;
    }

    .stat-icon {
        font-size: 4rem;
        opacity: 0.05;
        position: absolute;
        right: 20px;
        top: 10px;
        transition: all 0.3s ease;
        transform: rotate(-15deg);
    }

    .stat-card:hover .stat-icon {
        opacity: 0.1;
        transform: rotate(0deg) scale(1.1);
    }

    .stat-value {
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }

    .stat-label {
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .stat-footer {
        margin-top: 1rem;
        padding-top: 0.75rem;
        border-top: 1px solid rgba(0,0,0,0.05);
        font-size: 0.8rem;
    }

    /* Quick Actions */
    .action-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        cursor: pointer;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .action-card:hover {
        background-color: #f8f9fa;
        transform: translateY(-3px);
        border-color: #e0e0e0;
    }

    .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.25rem;
        color: white;
    }

    .action-title {
        font-weight: 600;
        color: #374151;
    }

    /* Table Styling */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e5e7eb;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 1rem 1.5rem;
    }

    .modern-table tbody tr {
        transition: background-color 0.2s ease;
        border-bottom: 1px solid #f3f4f6;
    }

    .modern-table tbody tr:last-child {
        border-bottom: none;
    }

    .modern-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .modern-table td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
    }

    .badge-custom {
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
        border-radius: 9999px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <!-- Top Profile Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 fw-bold text-gray-800">Dashboard</h2>
            <p class="text-muted mb-0">Welcome back, {{ auth()->user()->author_name }} <a href="{{ route('admin.author-data.edit') }}" class="btn-link" style="text-decoration: underline;">Edit Profile</a></p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light btn-sm shadow-sm d-none d-md-block">
                <i class="fas fa-calendar-alt text-primary"></i>
                <span class="ms-2 small">Today: {{ date('M d, Y') }}</span>
            </button>
            <div class="d-flex align-items-center bg-white rounded-pill px-3 py-2 shadow-sm border">
                <a href="{{ route('admin.author-data.edit') }}" class="text-decoration-none d-inline-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->author_name }}&background=6366f1&color=fff" alt="User" class="rounded-circle me-2" width="32" height="32">
                    <div class="d-none d-lg-block">
                        <div class="small fw-bold text-dark">{{ auth()->user()->author_name }}</div>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <!-- Statistics Cards Row 1 -->
    <div class="row g-4 mb-4">
        <!-- Total Blogs -->
        <div class="col-md-6 col-lg-3">
            <div class="card dashboard-card stat-card bg-gradient-to-br from-blue-50 to-white p-4">
                <i class="fas fa-newspaper stat-icon text-primary"></i>
                <div class="stat-body">
                    <div class="stat-label">Total Blogs</div>
                    <div class="stat-value text-primary text-uppercase">{{ number_format($total_blogs) }}</div>
                    <div class="stat-footer">
                        <span class="text-success fw-bold"><i class="fas fa-arrow-up"></i> {{ $published_blogs }}</span>
                        <span class="text-muted mx-2">Published</span>
                        <span class="text-warning fw-bold ms-2"><i class="fas fa-pen"></i> {{ $draft_blogs }}</span>
                        <span class="text-muted mx-2">Drafts</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQs -->
        <div class="col-md-6 col-lg-3">
            <div class="card dashboard-card stat-card bg-gradient-to-br from-amber-50 to-white p-4">
                <i class="fas fa-question-circle stat-icon text-warning"></i>
                <div class="stat-body">
                    <div class="stat-label">FAQs</div>
                    <div class="stat-value text-warning">{{ number_format($total_faqs) }}</div>
                    <div class="stat-footer">
                        <span class="text-muted">Knowledge base articles</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pages -->
        <div class="col-md-6 col-lg-3">
            <div class="card dashboard-card stat-card bg-gradient-to-br from-cyan-50 to-white p-4">
                <i class="fas fa-file-alt stat-icon text-info"></i>
                <div class="stat-body">
                    <div class="stat-label">Pages</div>
                    <div class="stat-value text-info">{{ number_format($total_pages) }}</div>
                    <div class="stat-footer">
                        <span class="text-muted">Static content pages</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tools -->
        <div class="col-md-6 col-lg-3">
            <div class="card dashboard-card stat-card bg-gradient-to-br from-purple-50 to-white p-4">
                <i class="fas fa-microchip stat-icon text-purple-600"></i>
                <div class="stat-body">
                    <div class="stat-label">Tools</div>
                    <div class="stat-value text-purple-600">{{ number_format($total_tools) }}</div>
                    <div class="stat-footer">
                        <span class="text-muted">Active utilities</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <!-- Added text-white -->
                <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center text-white">
                    <h5 class="fw-bold mb-0"><i class="fas fa-rocket text-primary me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('blogs.create') }}" class="action-card text-decoration-none">
                                <div class="action-icon bg-success shadow-sm">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="action-title">Create Blog</div>
                                <small class="text-muted">Start writing</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.pages.create') }}" class="action-card text-decoration-none">
                                <div class="action-icon bg-primary shadow-sm">
                                    <i class="fas fa-file-medical-alt"></i>
                                </div>
                                <div class="action-title">Add Page</div>
                                <small class="text-muted">Static content</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.faqs.create') }}" class="action-card text-decoration-none">
                                <div class="action-icon bg-warning shadow-sm text-dark">
                                    <i class="fas fa-question"></i>
                                </div>
                                <div class="action-title">New FAQ</div>
                                <small class="text-muted">Help center</small>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('tools.create') }}" class="action-card text-decoration-none">
                                <div class="action-icon bg-purple-600 shadow-sm">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <div class="action-title">Create Tool</div>
                                <small class="text-muted">Build utility</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Row -->
    <div class="row">
        <!-- Recent Blogs -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <!-- Added text-white -->
                <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center text-white">
                    <h5 class="fw-bold mb-0"><i class="fas fa-list-alt text-primary me-2"></i>Recent Blogs</h5>
                    <a href="{{ route('blogs.index') }}" class="btn btn-sm btn-outline-white rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($recent_blogs->isEmpty())
                        <div class="p-5 text-center text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                            <p>No blogs found yet.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="modern-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Published</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_blogs as $blog)
                                        <tr>
                                            <td>
                                                <div class="fw-bold text-dark">{{ Str::limit($blog->title, 50) }}</div>
                                                <div class="text-muted small">{{ $blog->created_at->diffForHumans() }}</div>
                                            </td>
                                            <td>
                                                <!-- Updated: Dark badge, white text -->
                                                <span class="badge badge-custom bg-dark text-white">
                                                    {{ $blog->category ?? 'Uncategorized' }}
                                                </span>
                                            </td>
                                            <td>
                                                <!-- Updated: Dark badge, white text -->
                                                <span class="badge badge-custom bg-dark text-white">
                                                    @if($blog->published)
                                                        <i class="fas fa-check-circle me-1"></i> Published
                                                    @else
                                                        <i class="fas fa-clock me-1"></i> Draft
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted d-block">{{ $blog->published_at ?? 'Not Published' }}</small>
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-light text-primary" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <!-- Remove View, kept Edit and Added Remove -->
                                                    <!-- Delete button removed -->
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-transparent border-top-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Showing recent activity</span>
                        <span class="text-muted small">{{ $recent_blogs->count() }} entries</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


