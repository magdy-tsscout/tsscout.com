@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)


<meta name="csrf-token" content="{{ csrf_token() }}">

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/faqs.css')}}" rel="stylesheet">
    <link href="{{asset('css/title-builder.css')}}" rel="stylesheet">
    <!-- Add FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
    <div class="header">eBay SmartTitles Tool</div>
    <p style="text-align: center;">Delve into the flexibility and customization our services offer to help your product succeed.</p>

    <div class="search-container">
        <input type="text" placeholder="Add keyword of your product" id="search-term">
        <button id="search-button">Search</button>
    </div>

    <div class="filter-container">
      <div class="filter-row">
          <!-- First row of filters -->
          <div class="filter-box">
              <label for="marketplace">MarketPlace
                  <i class="fas fa-question-circle" title="Select the marketplace for your product."></i>
              </label>
              <select id="marketplace">
                  <option value="ebay">ebay.com</option>
              </select>
          </div>
          <div class="filter-box">
              <label for="category">Shipping Location
                  <i class="fas fa-question-circle" title="Select the shipping location."></i>
              </label>
              <select id="country-id">
                <option value="Worldwide" selected>Worldwide</option>
                <option value="US">United States</option>
                <option value="GB">United Kingdom</option>
            </select>
          </div>

          <!-- New filter box for Sales Data Range -->
          <div class="filter-box">
              <label for="sales-date-range">Sales Data Range
                  <i class="fas fa-question-circle" title="Select the date range for sales data."></i>
              </label>
              <select id="sales-date-range" name="sales_date_range">
                  <option value="" disabled selected>Select Date Range</option>
                  <option value="last_7_days">Last 7 Days</option>
                  <option value="last_30_days">Last 30 Days</option>
                  <option value="this_month">This Month</option>
                  <option value="last_month">Last Month</option>
              </select>
          </div>

          <div class="filter-box">
              <label for="item-price">Exclude Phrase
                  <i class="fas fa-question-circle" title="Enter phrases you want to exclude from the search."></i>
              </label>
              <input type="text" id="item-price" placeholder="Ex: s1s2s3">
          </div>
      </div>
    </div>


    <div class="filter-container">
  <div class="filter-row">
    <!-- First row of filters -->
    <div class="filter-box" style="width: 95%;">
      <label for="marketplace">Title Combine
        <i class="fas fa-question-circle" title="Select the marketplace for your product."></i>
      </label>
      <div class="input-with-icon">
        <input type="text" id="item-price" placeholder="Click On Keyword to combine your title">
        <i class="fas fa-copy copy-icon" title="Copy"></i>
      </div>
    </div>
  </div>
</div>



    <!-- results section -->
    <div class="main-container">
    <div class="results-container">
    <!-- Long Tail Keywords Section -->
    <div class="results-section long-tail-keywords">
    <div class="section-header">
        <h2>Long Tail Keywords</h2>
        <div class="search-bar">
          <input type="text" placeholder="Search...">
          <i class="search-icon">🔍</i>
        </div>
      </div>
      <table class="results-table long-tail-keywords">
        <thead>
          <tr>
            <th>Keyword</th>
            <th>Average Searches</th>
            <th>Sales</th>
            <th></th> <!-- Empty header for Copy icon column -->
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div class="pagination-container" id="long-tail-pagination"></div>

    </div>

    <!-- Generic Keywords Section -->
    <div class="results-section generic-keywords">
    <div class="section-header">
        <h2>Generic Keywords</h2>
        <div class="search-bar">
          <input type="text" placeholder="Search...">
          <i class="search-icon">🔍</i>
        </div>
      </div>
      <table class="results-table generic-keywords">
        <thead>
          <tr>
            <th>Keyword</th>
            <th>Average Searches</th>
            <th>Sales</th>
            <th></th> <!-- Empty header for Copy icon column -->
          </tr>
        </thead>
        <tbody>
          <!-- Sample row data -->

          <!-- More rows as needed -->
        </tbody>
      </table>
      <div class="pagination-container" id="generic-pagination"></div>

    </div>
  </div>
</div>

<div class="loader-container" id="loader">
  <div class="loader"></div>
</div>


    <!-- end of results section -->

    <div class="latest-news" style="max-width: 100%; margin: 40px auto;">
        <div>
            <h2>Reach out to suppliers for details on <br>
              their offerings and pricing.</h2>
        </div>
        <div class="button-container">
          <a href="https://app.dropshippingscout.com/pricing">
            <button class="btn-default">Start for $1 Trial</button>
          </a>
      </div>
    </div>

    <div class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 offset-md-0">
                    <div class="accordion-title"><h3 class="accordion-MainTitle"></h3></div>
                    <div class="faq-accordion" id="accordion">
                        @foreach($faqs as $faq)
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s" data-category="{{ strtolower(str_replace(' ', '-', $faq->category_name)) }}">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                                     data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

  <script>
document.getElementById("search-button").addEventListener("click", async () => {
  const loader = document.getElementById("loader"); // Loader element
  loader.classList.add("active"); // Show loader

  const keywords = document.getElementById("search-term").value.trim();
  const locationValue = document.getElementById("country-id").value;
  const rangeValue = document.getElementById("sales-date-range").value;
  const negative = document.getElementById("item-price").value.trim();

  const location = locationValue || "Worldwide";
  const rangeMap = {
    "last_7_days": 7,
    "last_30_days": 30,
    "this_month": 30,
    "last_month": 30,
  };
  const range = rangeMap[rangeValue] || 14;

  if (!keywords) {
    alert("Please enter a keyword.");
    loader.classList.remove("active"); // Hide loader
    return;
  }

  const apiUrl = `https://app.dropshippingscout.com/api/title-Builder`;
  const apiKey = "633b70d7-b203-4097-9dac-cf72982df53c";

  try {
    const response = await fetch(
      `${apiUrl}?keywords=${encodeURIComponent(keywords)}&location=${encodeURIComponent(
        location
      )}&range=${range}&negative=${encodeURIComponent(negative)}`,
      {
        method: "GET",
        headers: {
          "API-KEY": apiKey,
        },
      }
    );

    if (!response.ok) {
      throw new Error(`API Error: ${response.status} - ${response.statusText}`);
    }

    const data = await response.json();

    // Populate tables and provided keyword details
    const providedKeyword = data.result?.providedKeyword || "N/A";
    const providedKeywordSales = data.result?.providedKeywordsSale || 0;
    const providedKeywordCompetition = data.result?.providedKeywordsCompetition || "N/A";

   /* document.querySelector(".provided-keyword").innerHTML = `
      <p><strong>Provided Keyword:</strong> ${providedKeyword}</p>
      <p><strong>Sales:</strong> ${providedKeywordSales}</p>
      <p><strong>Competition Level:</strong> ${providedKeywordCompetition}</p>
    `;*/

    const genericKeywords = data.result?.genericSingleKeywords || [];
    const genericTableBody = document.querySelector(".generic-keywords tbody");
    genericTableBody.innerHTML = "";

    genericKeywords.forEach((keyword) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${keyword.singleKeyWord}</td>
        <td>${keyword.search}</td>
        <td>${keyword.sales}</td>
      `;
      genericTableBody.appendChild(row);
    });

    const longTailKeywords = data.result?.longTailKeywords || [];
    const longTailTableBody = document.querySelector(".long-tail-keywords tbody");
    longTailTableBody.innerHTML = "";

    longTailKeywords.forEach((keyword) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${keyword.key}</td>
        <td>${keyword.count}</td>
        <td>${keyword.sales}</td>
      `;
      longTailTableBody.appendChild(row);
    });
  } catch (error) {
    console.error("Error:", error);
    alert(`An error occurred: ${error.message}`);
  } finally {
    loader.classList.remove("active"); // Hide loader
  }
});



</script>

<script>

/**
 * Utility function to paginate data and render a table with pagination controls.
 * @param {Array} data - Array of data to paginate.
 * @param {string} tableBodySelector - Selector for the table's <tbody>.
 * @param {string} paginationContainerSelector - Selector for the pagination container.
 * @param {number} rowsPerPage - Number of rows per page.
 */
function paginateTable(data, tableBodySelector, paginationContainerSelector, rowsPerPage = 10) {
  const tableBody = document.querySelector(tableBodySelector);
  const paginationContainer = document.querySelector(paginationContainerSelector);
  let currentPage = 1;

  function renderTable(page) {
    // Calculate the start and end indices for the rows on the current page
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    // Render rows
    tableBody.innerHTML = "";
    const rows = data.slice(start, end);
    rows.forEach((row) => {
      const tr = document.createElement("tr");
      tr.innerHTML = Object.values(row)
        .map((value) => `<td>${value}</td>`)
        .join("");
      tableBody.appendChild(tr);
    });

    // Update pagination controls
    renderPaginationControls(page);
  }

  function renderPaginationControls(page) {
    const totalPages = Math.ceil(data.length / rowsPerPage);
    paginationContainer.innerHTML = "";

    const paginationList = document.createElement("ul");
    paginationList.className = "pagination";

    // Previous button
    const prev = document.createElement("li");
    prev.textContent = "«";
    prev.className = page === 1 ? "disabled" : "";
    prev.addEventListener("click", () => {
      if (page > 1) renderTable(page - 1);
    });
    paginationList.appendChild(prev);

    // Page buttons
    for (let i = 1; i <= totalPages; i++) {
      const pageItem = document.createElement("li");
      pageItem.textContent = i;
      pageItem.className = page === i ? "active" : "";
      pageItem.addEventListener("click", () => renderTable(i));
      paginationList.appendChild(pageItem);
    }

    // Next button
    const next = document.createElement("li");
    next.textContent = "»";
    next.className = page === totalPages ? "disabled" : "";
    next.addEventListener("click", () => {
      if (page < totalPages) renderTable(page + 1);
    });
    paginationList.appendChild(next);

    paginationContainer.appendChild(paginationList);
  }

  // Initial render
  renderTable(currentPage);
}

// Example: Populate tables with pagination
document.getElementById("search-button").addEventListener("click", async () => {
  // Assume fetchData() is the function that fetches API data
  const data = await fetchData();

  const longTailKeywords = data.result.longTailKeywords.map((item) => ({
    Keyword: item.key,
    Count: item.count,
    Sales: item.sales,
  }));

  const genericKeywords = data.result.genericSingleKeywords.map((item) => ({
    Keyword: item.singleKeyWord,
    Searches: item.search,
    Sales: item.sales,
  }));

  // Paginate tables
  paginateTable(
    longTailKeywords,
    ".long-tail-keywords tbody",
    "#long-tail-pagination"
  );
  paginateTable(
    genericKeywords,
    ".generic-keywords tbody",
    "#generic-pagination"
  );
});


</script>




@endsection