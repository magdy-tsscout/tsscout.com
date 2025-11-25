@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)


@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/faqs.css')}}" rel="stylesheet">
    <link href="{{asset('css/ebay-calculator.css')}}" rel="stylesheet">

 @endsection

@section('content')
    <div class="header">eBay Fee Calculator</div>
    <p style="text-align: center;">Delve into the flexibility and customization oure services offer to help your product succeed.</p>

    <div class="search-container">
        <input id="itemIdInput" type="text" placeholder="Check Fees By Item ID">
        <button>Search</button>
    </div>

    <div class="filter-container">
      <div class="filter-row">
          <!-- First row of filters -->
          <div class="filter-box">
              <label for="marketplace">MarketPlace</label>
              <select id="marketplaceSelect" onchange="populateCategories()">
                <option value="">Select a Marketplace</option>
              </select>
          </div>
          <div class="filter-box">
              <label for="category">Category</label>
              <select id="categorySelect">
                <option value="">Select a Category</option>
             </select>
          </div>
          <div class="filter-box">
              <label for="item-price">Item Sold Price</label>
              <input type="number" id="item-price" placeholder="Enter Price">
          </div>
          <div class="filter-box">
              <label for="item-cost">Item Cost</label>
              <input type="number" id="item-cost" placeholder="Enter Cost">
          </div>
          <div class="filter-box">
              <label for="ebay-fee">eBay Fee %</label>
              <input type="number" id="ebay-fee" placeholder="Enter Fee %">
          </div>
      </div>
  
      <!-- Second row of filters (hidden by default) -->
      <div class="filter-row" id="second-filter-row" style="display: none;">
          <div class="filter-box">
              <label for="shipping-charge">Shipping Charge</label>
              <input type="number" id="shipping-charge" placeholder="Enter Charge">
          </div>
          <div class="filter-box">
              <label for="shipping-cost">Shipping Cost</label>
              <input type="number" id="shipping-cost" placeholder="Enter Cost">
          </div>
          <div class="filter-box">
              <label for="promotion">Promotion %</label>
              <input type="number" id="promotion" placeholder="Enter Promotion %">
          </div>
          <div class="filter-box">
              <label for="other-costs">Other Costs</label>
              <input type="number" id="other-costs" placeholder="Enter Other Costs">
          </div>
          <div class="filter-box">
              <label for="ebay-store">eBay Store</label>
              <input type="number" id="ebay-store" placeholder="1">
          </div>
          <div class="filter-box">
            <label for="other-costs">Seller Status</label>
            <input type="number" id="seller-status" placeholder="1"> <!-- Updated ID -->
            </div>
      </div>
  
      <!-- More Options Link -->
      <div style="text-align: center; margin: 20px 0;" id="more-options-container">
          <a href="javascript:void(0);" id="more-options-link" class="more-options-link">
              More Options
              <span class="arrow down"></span>
          </a>
      </div>
  </div>
  <div class="ebay-container">
    <!-- First Column -->
    <div class="ebay-column">
      <div class="ebay-header">Your Profit</div>
      <div class="ebay-property">
        <span>Total Profit:</span>
        <span id="total-profit" class="ebay-value">$0.00</span>
        </div>
      <div class="ebay-property">
        <span>Profit %:</span>
        <span id="profit-percent" class="ebay-value">0.00%</span>
        </div>
    </div>

    <!-- Middle Column with Two Sections -->
    <div class="ebay-column ebay-middle-column">
      <div class="ebay-middle-container">
        <!-- Left Side of Middle Column -->
        <div class="ebay-middle-section">
          <div class="ebay-header">Profit & Fees Breakdown</div>
          <div class="ebay-property">
            <span>Sold Price:</span>
            <span id="sold-price" class="ebay-value">$0.00</span>
            </div>
          <div class="ebay-property">
            <span>Final Value Fee:</span>
            <span id="total-ebay-fees" class="ebay-value">$0.00</span>
            </div>
          <div class="ebay-property">
            <span>Fixed Transaction Fee:</span>
            <span id="transaction-fee-percent" class="ebay-value">0.00%</span>
            </div>
          <div class="ebay-property">
            <span>Promotion Fees:</span>
            <span id="promotion-fee" class="ebay-value">0.00%</span>
            </div>
          <div class="ebay-property">
            <span>Total eBay Fees:</span>
            <span id="total-ebay-fees" class="ebay-value">0.00%</span>
            </div>
          <div class="ebay-property">
            <span>Total eBay Fees %:</span>
            <span id="total-ebay-fees-percent" class="ebay-value">0.00%</span>
            </div>
        </div>

        <!-- Divider Line -->
        <div class="divider"></div>

        <!-- Right Side of Middle Column -->
        <div class="ebay-middle-section">
          <div class="ebay-header">Other Costs</div>
          <div class="ebay-property">
            <span>Item Cost:</span>
            <span id="item-cost-value" class="ebay-value">$0.00</span>
            </div>
          <div class="ebay-property">
            <span>Shipping Cost:</span>
            <span id="shipping-cost-value" class="ebay-value">$0.00</span>
            </div>
          <div class="ebay-property">
            <span>Other Costs:</span>
            <span id="other-costs-value" class="ebay-value">$0.00</span>
            </div>
          <div class="ebay-property">
            <span>Total Cost:</span>
            <span id="total-cost" class="ebay-value">$0.00</span>
            </div>
          <div class="ebay-property">
            <span>Total Cost %:</span>
            <span id="total-cost-percent" class="ebay-value">0.00%</span>
            </div>
        </div>
      </div>
    </div>

    <!-- Third Column -->
    <div class="ebay-column">
      <div class="ebay-header"></div>
      <div class="ebay-property">
        <span>Break Even Profit:</span>
        <span id="break-even-profit" class="ebay-value">$0.00</span>
        </div>
      <div class="ebay-property">
        <span>Profit Margin:</span>
        <span id="profit-margin" class="ebay-value">0.00%</span>
        </div>
      <div class="ebay-property">
        <span>Total Profit:</span>
        <span id="final-total-profit" class="ebay-value">$0.00</span>
        </div>
    </div>
  </div>

  <div class="latest-news" style="max-width: 80%; margin: 40px auto;">
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
    // Load the JSON file
    async function loadMarketplaces() {
        try {
            const response = await fetch('/storage/marketplaces.json');  // Make sure this path is correct
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            console.log(data);  // Output the marketplaces data to the console
            return data;
        } catch (error) {
            console.error('Failed to load marketplaces:', error);
            alert('Failed to load marketplaces. Please try again later.'); // Display an alert to the user if there's an error
        }
    }

    // Initialize marketplaces data
    let marketplacesData = {};

    // Load marketplaces and populate the marketplace dropdown
    async function initMarketplaces() {
        marketplacesData = await loadMarketplaces();
        const marketplaceSelect = document.getElementById('marketplaceSelect');

        if (marketplacesData) {
            for (const [key, marketplace] of Object.entries(marketplacesData)) {
                const option = document.createElement('option');
                option.value = key;
                option.textContent = marketplace.name;
                marketplaceSelect.appendChild(option);
            }
        }

        // Populate categories after loading the marketplaces
        populateCategories();
    }

    // Populate categories based on the selected marketplace
    function populateCategories() {
        const marketplaceSelect = document.getElementById('marketplaceSelect');
        const categorySelect = document.getElementById('categorySelect');
        const selectedMarketplaceKey = marketplaceSelect.value;

        // Clear the category dropdown
        categorySelect.innerHTML = '<option value="">Select a Category</option>';

        if (selectedMarketplaceKey && marketplacesData[selectedMarketplaceKey]) {
            const categories = marketplacesData[selectedMarketplaceKey].categories;

            categories.forEach((category) => {
                const option = document.createElement('option');
                option.value = category;
                option.textContent = category;
                categorySelect.appendChild(option);
            });
        }
    }

    document.querySelector('.search-container button').addEventListener('click', performCalculation);

    async function performCalculation() {
        // Capture input values
        const itemId = document.getElementById('itemIdInput').value.trim(); // Get itemId and remove leading/trailing spaces
        const marketplaceKey = document.getElementById('marketplaceSelect').value;
        const category = document.getElementById('categorySelect').value;
        const soldPrice = parseFloat(document.getElementById('item-price').value) || 0;
        const itemCost = parseFloat(document.getElementById('item-cost').value) || 0;
        const ebayFee = parseFloat(document.getElementById('ebay-fee').value) || 0;

        // Optional inputs if "More Options" is clicked
        const shippingCharge = parseFloat(document.getElementById('shipping-charge').value) || 0;
        const shippingCost = parseFloat(document.getElementById('shipping-cost').value) || 0;
        const promotion = parseFloat(document.getElementById('promotion').value) || 0;
        const otherCosts = parseFloat(document.getElementById('other-costs').value) || 0;

        // Validate itemId - should be alphanumeric and between 5 and 20 characters
        if (!itemId) {
            alert('Item ID is required.');
            return; // Stop the calculation if itemId is empty
        }
        if (!/^[a-zA-Z0-9]{5,20}$/.test(itemId)) {  // Regular expression for alphanumeric and length check
            alert('Item ID must be alphanumeric and between 5 and 20 characters long.');
            return; // Stop the calculation if itemId does not match the pattern
        }

        // Calculate eBay fees and profit
        const totalEbayFees = soldPrice * (ebayFee / 100);
        const promotionFees = soldPrice * (promotion / 100);
        const totalCosts = itemCost + shippingCost + otherCosts + totalEbayFees + promotionFees;
        const profit = soldPrice - totalCosts;
        const profitPercentage = (profit / soldPrice) * 100;

        // Update the profit display values
        document.getElementById('total-profit').textContent = `$${profit.toFixed(2)}`;
        document.getElementById('profit-percent').textContent = `${profitPercentage.toFixed(2)}%`;

        // Update fee breakdown values
        document.getElementById('sold-price').textContent = `$${soldPrice.toFixed(2)}`;
        document.getElementById('total-ebay-fees').textContent = `$${totalEbayFees.toFixed(2)}`;
        document.getElementById('transaction-fee-percent').textContent = `${ebayFee}%`;
        document.getElementById('promotion-fee').textContent = `${promotion}%`;
        document.getElementById('other-costs-value').textContent = `$${otherCosts.toFixed(2)}`;

        // Update other costs section values
        document.getElementById('item-cost-value').textContent = `$${itemCost.toFixed(2)}`;
        document.getElementById('shipping-cost-value').textContent = `$${shippingCost.toFixed(2)}`;
        document.getElementById('total-cost').textContent = `$${totalCosts.toFixed(2)}`;
        document.getElementById('total-cost-percent').textContent = `${((totalCosts / soldPrice) * 100).toFixed(2)}%`;

        // Display break-even and profit margin calculations
        const breakEvenProfit = soldPrice - totalCosts;
        const profitMargin = profitPercentage.toFixed(2);

        document.getElementById('break-even-profit').textContent = `$${breakEvenProfit >= 0 ? breakEvenProfit.toFixed(2) : '0.00'}`;
        document.getElementById('profit-margin').textContent = `${profitMargin}%`;
    }

    // Update categories when the marketplace is changed
    document.getElementById('marketplaceSelect').addEventListener('change', populateCategories);

    // Initialize marketplaces when the page loads
    window.onload = initMarketplaces;
</script>



 @endsection