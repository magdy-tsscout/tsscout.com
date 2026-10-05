@extends('layouts.app')

@section('content')
    <h1>Pages
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary float-right">
            <span class="fa fa-plus"></span>
            Create New Page
        </a>
    </h1>

    <div class="row mt-4">
        @foreach($pages as $page)
            <div class="col-12 col-lg-6 col-xl-4 mb-4">
                <div class="card h-100 page-card">
                    <div class="card-body d-flex flex-column">
                        <p class="text-muted mb-2 page-card-label">Page</p>
                        <h5 class="card-title mb-3 page-card-title">
                            <a href="{{ url($page->slug) }}" target="_blank" class="page-card-link">
                                <span class="fa fa-eye mr-1"></span>
                                {{ $page->title }}
                            </a>
                        </h5>

                        <div class="mb-2">
                            <span class="text-muted page-card-label">View Name</span>
                            <p class="mb-0 font-weight-bold text-dark text-break">{{ $page->view_name }}</p>
                        </div>

                        <div class="mt-3">
                            <span class="text-muted page-card-label d-block mb-1">Sitemap</span>
                            <form action="{{ route('admin.pages.update-sitemap') }}" method="POST" class="mb-0 d-inline-block js-sitemap-toggle-form">
                                @csrf
                                <input type="hidden" name="page_id" value="{{ $page->id }}">
                                <div class="custom-control custom-switch">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input js-sitemap-toggle"
                                        id="sitemap_toggle_{{ $page->id }}"
                                        name="include_in_sitemap"
                                        value="1"
                                        {{ $page->include_in_sitemap ? 'checked' : '' }}
                                    >
                                    <label class="custom-control-label sitemap-toggle-label js-sitemap-toggle-label" for="sitemap_toggle_{{ $page->id }}">
                                        {{ $page->include_in_sitemap ? 'Included' : 'Excluded' }}
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0 pb-3 px-3">
                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-flex justify-content-end">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group" aria-label="Actions">
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('styles')
<style>
    .page-card {
        border: 1px solid #a9aeb8;
        /* border-radius: 12px; */
        box-shadow: 0 6px 16px rgba(18, 38, 63, 0.06);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .page-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(18, 38, 63, 0.1);
    }

    .page-card-title {
        font-size: 1.05rem;
        line-height: 1.4;
        min-height: 2.8em;
    }

    .page-card-link {
        color: #1f3b64;
        text-decoration: none;
    }

    .page-card-link:hover {
        color: #2f5ca1;
        text-decoration: none;
    }

    .page-card-label {
        font-size: 0.75rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .sitemap-toggle-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1f3b64;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var forms = document.querySelectorAll('.js-sitemap-toggle-form');
    var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';
    var notify = function (icon, message) {
        if (window.Swal) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: message,
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true
            });
            return;
        }

        window.alert(message);
    };

    forms.forEach(function (form) {
        var toggle = form.querySelector('.js-sitemap-toggle');
        var label = form.querySelector('.js-sitemap-toggle-label');

        if (!toggle || !label) {
            return;
        }

        toggle.addEventListener('change', function () {
            var previousState = !toggle.checked;

            toggle.disabled = true;

            var formData = new URLSearchParams();
            formData.append('page_id', form.querySelector('input[name="page_id"]').value);

            if (toggle.checked) {
                formData.append('include_in_sitemap', '1');
            } else {
                formData.append('include_in_sitemap', '0');
            }

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: formData.toString()
            })
                .then(function (response) {
                    if (!response.ok) {
                        return response.json()
                            .then(function (payload) {
                                throw new Error(payload.message || 'Could not update sitemap setting.');
                            })
                            .catch(function () {
                                throw new Error('Could not update sitemap setting.');
                            });
                    }

                    return response.json();
                })
                .then(function (data) {
                    var included = Boolean(data.include_in_sitemap);
                    toggle.checked = included;
                    label.textContent = included ? 'Included' : 'Excluded';
                    notify('success', data.message || (included ? 'Page included in sitemap successfully.' : 'Page excluded from sitemap successfully.'));
                })
                .catch(function (error) {
                    toggle.checked = previousState;
                    label.textContent = previousState ? 'Included' : 'Excluded';
                    notify('error', error.message || 'Could not update sitemap setting. Please try again.');
                })
                .finally(function () {
                    toggle.disabled = false;
                });
        });
    });
});
</script>
@endsection
