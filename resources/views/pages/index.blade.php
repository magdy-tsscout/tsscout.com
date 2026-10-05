@extends('layouts.app')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h1 class="mb-2 mb-md-0">Pages</h1>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
            <span class="fa fa-plus"></span>
            Create New Page
        </a>
    </div>

    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
        <div class="mb-2 mb-md-0 w-100 mr-md-2">
            <input
                type="text"
                id="pagesSearchInput"
                class="form-control"
                placeholder="Search pages by title or view name..."
            >
        </div>
        <button type="button" id="pagesViewToggleBtn" class="btn btn-outline-primary">
            <i class="fas fa-table mr-1"></i> Switch to Table
        </button>
    </div>

    <div id="pagesCardsView" class="row mt-2">
        @foreach($pages as $page)
            <div
                class="col-12 col-lg-6 col-xl-4 mb-4 js-page-item"
                data-search="{{ strtolower($page->title . ' ' . $page->view_name . ' ' . $page->slug) }}"
            >
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
                                        id="card_sitemap_toggle_{{ $page->id }}"
                                        name="include_in_sitemap"
                                        value="1"
                                        {{ $page->include_in_sitemap ? 'checked' : '' }}
                                    >
                                    <label class="custom-control-label sitemap-toggle-label js-sitemap-toggle-label" for="card_sitemap_toggle_{{ $page->id }}">
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

    <div id="pagesCardsEmptyState" class="alert alert-light border d-none">
        No pages found for this search.
    </div>

    <div id="pagesTableView" class="table-responsive d-none">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Title</th>
                    <th>View Name</th>
                    <th>Slug</th>
                    <th>Include in Sitemap</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr
                        class="js-page-item"
                        data-search="{{ strtolower($page->title . ' ' . $page->view_name . ' ' . $page->slug) }}"
                    >
                        <td>
                            <a href="{{ url($page->slug) }}" target="_blank" class="page-card-link">
                                <span class="fa fa-eye mr-1"></span>{{ $page->title }}
                            </a>
                        </td>
                        <td>{{ $page->view_name }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>
                            <form action="{{ route('admin.pages.update-sitemap') }}" method="POST" class="mb-0 js-sitemap-toggle-form">
                                @csrf
                                <input type="hidden" name="page_id" value="{{ $page->id }}">
                                <div class="custom-control custom-switch">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input js-sitemap-toggle"
                                        id="table_sitemap_toggle_{{ $page->id }}"
                                        name="include_in_sitemap"
                                        value="1"
                                        {{ $page->include_in_sitemap ? 'checked' : '' }}
                                    >
                                    <label class="custom-control-label sitemap-toggle-label js-sitemap-toggle-label" for="table_sitemap_toggle_{{ $page->id }}">
                                        {{ $page->include_in_sitemap ? 'Included' : 'Excluded' }}
                                    </label>
                                </div>
                            </form>
                        </td>
                        <td class="text-right">
                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline-flex">
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="pagesTableEmptyState" class="alert alert-light border d-none">
        No pages found for this search.
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
    var cardsView = document.getElementById('pagesCardsView');
    var tableView = document.getElementById('pagesTableView');
    var viewToggleBtn = document.getElementById('pagesViewToggleBtn');
    var searchInput = document.getElementById('pagesSearchInput');
    var cardItems = cardsView ? cardsView.querySelectorAll('.js-page-item') : [];
    var tableItems = tableView ? tableView.querySelectorAll('.js-page-item') : [];
    var cardsEmptyState = document.getElementById('pagesCardsEmptyState');
    var tableEmptyState = document.getElementById('pagesTableEmptyState');
    var viewStorageKey = 'admin-pages-display-mode';
    var displayMode = localStorage.getItem(viewStorageKey) || 'cards';
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

    var setToggleButtonText = function (mode) {
        if (!viewToggleBtn) {
            return;
        }

        if (mode === 'cards') {
            viewToggleBtn.innerHTML = '<i class="fas fa-table mr-1"></i> Switch to Table';
            return;
        }

        viewToggleBtn.innerHTML = '<i class="fas fa-th-large mr-1"></i> Switch to Cards';
    };

    var setDisplayMode = function (mode) {
        displayMode = mode === 'table' ? 'table' : 'cards';

        if (cardsView) {
            cardsView.classList.toggle('d-none', displayMode !== 'cards');
        }

        if (tableView) {
            tableView.classList.toggle('d-none', displayMode !== 'table');
        }

        setToggleButtonText(displayMode);
        localStorage.setItem(viewStorageKey, displayMode);
        applySearch(searchInput ? searchInput.value : '');
    };

    var applySearch = function (queryText) {
        var query = (queryText || '').toLowerCase().trim();
        var visibleCardCount = 0;
        var visibleTableCount = 0;

        cardItems.forEach(function (item) {
            var haystack = (item.dataset.search || '').toLowerCase();
            var matches = query === '' || haystack.indexOf(query) !== -1;
            item.hidden = !matches;
            if (matches) {
                visibleCardCount++;
            }
        });

        tableItems.forEach(function (item) {
            var haystack = (item.dataset.search || '').toLowerCase();
            var matches = query === '' || haystack.indexOf(query) !== -1;
            item.hidden = !matches;
            if (matches) {
                visibleTableCount++;
            }
        });

        if (cardsEmptyState) {
            cardsEmptyState.classList.toggle('d-none', displayMode !== 'cards' || visibleCardCount > 0);
        }

        if (tableEmptyState) {
            tableEmptyState.classList.toggle('d-none', displayMode !== 'table' || visibleTableCount > 0);
        }
    };

    if (viewToggleBtn) {
        viewToggleBtn.addEventListener('click', function () {
            setDisplayMode(displayMode === 'cards' ? 'table' : 'cards');
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            applySearch(searchInput.value);
        });
    }

    setDisplayMode(displayMode);

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
