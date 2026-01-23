<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Scouter Pro — Winners Analytics</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind theme overrides -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif'],
          },
          colors: {
            brand: {
              navy: "#1E3F5B",     /* deep navy from your hero */
              ink:  "#0E1A34",
              blue: "#2453FF",
              lime: "#C6F74A",     /* neon-lime accent from headline */
              mint: "#E9FFD1",
            }
          },
          boxShadow: {
            soft: "0 10px 30px rgba(20,33,61,.08)",
            glow: "0 10px 40px rgba(36,83,255,.25)",
          },
          borderRadius: {
            card: "18px",
          },
          keyframes: {
            float: { "0%,100%": { transform:"translateY(0)" }, "50%": { transform:"translateY(-6px)" } },
            fadeInUp: { "0%":{opacity:0,transform:"translateY(10px)"}, "100%":{opacity:1,transform:"translateY(0)"} },
            zoomIn: { "0%":{transform:"scale(1)"}, "100%":{transform:"scale(1.1)"} },
            fadeIn: { "0%":{opacity:0}, "100%":{opacity:1} },
            scaleIn: { "0%":{opacity:0,transform:"scale(0.9)"}, "100%":{opacity:1,transform:"scale(1)"} }
          },
          animation: {
            float: "float 6s ease-in-out infinite",
            fadeInUp: "fadeInUp .6s ease-out both",
            zoomIn: "zoomIn 0.3s ease-out forwards",
            fadeIn: "fadeIn 0.2s ease-out forwards",
            scaleIn: "scaleIn 0.3s ease-out forwards"
          }
        }
      }
    }
  </script>

  <style>
    :root{
      --bg-grad: radial-gradient(1200px 600px at 85% -10%, rgba(198,247,74,.35), transparent 60%),
                 radial-gradient(900px 500px at -10% 10%, rgba(36,83,255,.20), transparent 55%),
                 linear-gradient(180deg, #F7FAFF 0%, #F0F5FF 100%);
    }
    .glass {
      background: rgba(255,255,255,.72);
      backdrop-filter: blur(8px);
    }
    /* Pretty scrollbars for table container */
    .pretty-scroll::-webkit-scrollbar{height:10px}
    .pretty-scroll::-webkit-scrollbar-thumb{background:#D7E2FF;border-radius:8px}
    /* Table sticky header shadow-on-scroll */
    .sticky-head:where(thead){position: sticky; top: 0; z-index: 10;}

    .bg-brand-lime\/40 {
    background-color: rgb(255 255 255 / 40%) !important;
}

    .bg-dark{
    --tw-bg-opacity: 1;
    background-color: #1e3f5b !important;
        color: white !important;
    }
    .bg-brand-blue{
      background-color: #3545D8 !important;
    }

    /* Image zoom effect */
    .image-zoom-container {
      position: relative;
      display: inline-block;
      overflow: visible;
      border-radius: 8px;
    }

    .image-zoom {
      transition: transform 0.3s ease, z-index 0.3s ease;
      cursor: pointer;
      position: relative;
      z-index: 1;
    }

    .image-zoom-container:hover .image-zoom {
      transform: scale(3.5) translateX(50px);
      z-index: 100;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      border-radius: 8px;
    }

    /* Pagination styles */
    .pagination {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .pagination li {
      margin: 0 2px;
    }

    .pagination a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 8px;
      text-decoration: none;
      color: #1E3F5B;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .pagination a:hover {
      background-color: #E9FFD1;
    }

    .pagination .active a {
      background-color: #1E3F5B;
      color: white;
    }

    /* Sidebar styles */
    .sidebar-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 12px 0;
      color: #1E3F5B;
      border-radius: 8px;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .sidebar-icon:hover {
      background-color: #E9FFD1;
      color: #1E3F5B;
    }

    .sidebar-icon.active {
      background-color: #1E3F5B;
      color: white;
    }

    .sidebar-tooltip {
      position: absolute;
      left: 100%;
      top: 50%;
      transform: translateY(-50%);
      background-color: #1E3F5B;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s ease;
      z-index: 30;
    }

    .sidebar-icon:hover .sidebar-tooltip {
      opacity: 1;
    }

    /* Hide results initially */
    .results-section {
      display: none;
    }

    /* Image Modal Styles */
    .image-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      z-index: 100;
      align-items: center;
      justify-content: center;
      animation: fadeIn 0.3s ease-out forwards;
    }

    .image-modal.active {
      display: flex;
    }

    .modal-content {
      max-width: 90%;
      max-height: 90%;
      position: relative;
      animation: scaleIn 0.3s ease-out forwards;
    }

    .modal-image {
      max-width: 100%;
      max-height: 80vh;
      border-radius: 12px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .modal-close {
      position: absolute;
      top: -40px;
      right: 0;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: none;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 18px;
      transition: all 0.2s ease;
    }

    .modal-close:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: scale(1.1);
    }

    .modal-title {
      position: absolute;
      bottom: -50px;
      left: 0;
      width: 100%;
      text-align: center;
      color: white;
      font-size: 16px;
      font-weight: 500;
      padding: 10px;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 8px;
    }

    /* Mobile card layout improvements */
    .mobile-card-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-top: 10px;
    }

    .mobile-card-cell {
      display: flex;
      flex-direction: column;
      padding: 8px;
      background: #f8fafc;
      border-radius: 8px;
      border: 1px solid #e2e8f0;
    }

    .mobile-card-label {
      font-size: 11px;
      color: #64748b;
      margin-bottom: 4px;
      font-weight: 500;
    }

    .mobile-card-value {
      font-size: 13px;
      font-weight: 600;
      color: #1E3F5B;
    }

    /* Filter tooltip styles */
    .filter-tooltip {
      position: relative;
      display: inline-block;
      margin-left: 5px;
    }

    .filter-tooltip .tooltip-text {
      visibility: hidden;
      width: 220px;
      background-color: #1E3F5B;
      color: white;
      text-align: center;
      border-radius: 6px;
      padding: 8px 12px;
      position: absolute;
      z-index: 1000;
      bottom: 125%;
      left: 50%;
      transform: translateX(-50%);
      opacity: 0;
      transition: opacity 0.3s;
      font-size: 12px;
      line-height: 1.4;
    }

    .filter-tooltip:hover .tooltip-text {
      visibility: visible;
      opacity: 1;
    }

    /* KPI tooltip styles */
    .kpi-tooltip {
      position: relative;
      display: inline-block;
      margin-left: 5px;
    }

    .kpi-tooltip .tooltip-text {
      visibility: hidden;
      width: 200px;
      background-color: #1E3F5B;
      color: white;
      text-align: center;
      border-radius: 6px;
      padding: 8px 12px;
      position: absolute;
      z-index: 1000;
      bottom: 125%;
      left: 50%;
      transform: translateX(-50%);
      opacity: 0;
      transition: opacity 0.3s;
      font-size: 12px;
      line-height: 1.4;
    }

    .kpi-tooltip:hover .tooltip-text {
      visibility: visible;
      opacity: 1;
    }

    /* Table header tooltip styles - FIXED */
    .th-tooltip {
      position: relative;
      cursor: pointer;
      display: inline-block;
    }

    .th-tooltip .tooltip-text {
      visibility: hidden;
      width: 200px;
      background-color: #1E3F5B;
      color: white;
      text-align: center;
      border-radius: 6px;
      padding: 10px;
      position: absolute;
      z-index: 1000;
      /* Position BELOW the header */
      top: 100%;
      left: 50%;
      transform: translateX(-50%) translateY(10px);
      opacity: 0;
      transition: all 0.3s ease;
      font-size: 12px;
      line-height: 1.4;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      white-space: normal;
      margin-top: 15px;
    }

    .th-tooltip .tooltip-text::after {
      content: "";
      position: absolute;
      bottom: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: transparent transparent #1E3F5B transparent;
    }

    .th-tooltip:hover .tooltip-text {
      visibility: visible;
      opacity: 1;
      transform: translateX(-50%) translateY(0);
    }

    /* Performance icons */
    .performance-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      font-size: 12px;
    }

    .performance-best {
      background-color: #10B981;
      color: white;
    }

    .performance-good {
      background-color: #3B82F6;
      color: white;
    }

    .performance-average {
      background-color: #F59E0B;
      color: white;
    }

    /* Image preview tooltip */
    .image-preview-tooltip {
      position: absolute;
      bottom: 100%;
      left: 50%;
      transform: translateX(-50%);
      background: white;
      border-radius: 8px;
      padding: 8px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      z-index: 100;
      display: none;
      width: 180px;
    }

    .image-preview-tooltip img {
      width: 100%;
      height: auto;
      border-radius: 4px;
      margin-bottom: 5px;
    }

    .image-preview-tooltip .preview-title {
      font-size: 12px;
      color: #1E3F5B;
      font-weight: 500;
      text-align: center;
    }

    .image-zoom-container:hover .image-preview-tooltip {
      display: block;
    }
    #filterToggle{
      z-index: 0;
    }

    
/* Mobile sidebar positioning - only when expanded */
@media (max-width: 768px) {
  #sidebar:not(.hidden) {
    top: 78px !important;
    height: calc(100vh - 80px) !important;
  }
  

  /* When sidebar is hidden (circle state), keep original positioning */
  #sidebar.hidden {
    top: 0 !important;
    height: 100vh !important;
  }
}

/* Ensure header has proper height on mobile */
@media (max-width: 768px) {
  header .glass {
    min-height: 70px;
  }
}

/* Adjust main content for mobile */
@media (max-width: 768px) {
  .ml-16 {
    margin-left: 0 !important;
  }
}

.w-12{
  width: 6rem !important;
}

.h-12{
  height: 7rem !important;
}

/* Table cell borders */
#tableBody tr {
  border-bottom: 1px solid #f1f5f9;
}

#tableBody td {
  padding: 12px 15px;
  border-right: 1px solid #f8fafc;
}

#tableBody td:last-child {
  border-right: none;
}

/* Export button responsiveness */
@media (max-width: 640px) {
  #exportCSV {
    padding: 8px 12px;
    font-size: 14px;
    width: auto;
    white-space: nowrap;
  }
  
  .px-5.py-4.flex.flex-col.md\:flex-row.md\:items-center.md\:justify-between.gap-3 {
    flex-direction: column;
    gap: 15px;
  }
  
  .px-5.py-4.flex.flex-col.md\:flex-row.md\:items-center.md\:justify-between.gap-3 > div:last-child {
    width: 100%;
    display: flex;
    gap: 10px;
  }
  
  #tableSearch {
    flex: 1;
    min-width: 0;
  }
}

/* Table header sorting styles */
.sortable {
  cursor: pointer;
  user-select: none;
  position: relative;
  padding-right: 25px !important;
}

.sortable:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

.sortable::after {
  content: "↕";
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 12px;
  opacity: 0.7;
}

.sortable.asc::after {
  content: "↑";
  opacity: 1;
  color: #C6F74A;
}

.sortable.desc::after {
  content: "↓";
  opacity: 1;
  color: #C6F74A;
}

/* Table container with borders */
.table-container {
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  overflow: hidden;
  margin: 0 15px;
  background: white;
}

@media (min-width: 768px) {
  .table-container {
    margin: 0 20px;
  }
}

/* Mobile/Desktop responsive display */
@media (max-width: 767px) {
  #mobileCards {
    display: block;
    padding: 15px;
  }
  
  #productsTable {
    display: none;
  }
  
  .pretty-scroll {
    display: none;
  }
  
  .table-container {
    display: none;
  }
}

@media (min-width: 768px) {
  #mobileCards {
    display: none !important;
  }
  
  #productsTable {
    display: table;
  }
  
  .pretty-scroll {
    display: block;
  }
  
  .table-container {
    display: block;
  }
}

/* Mobile image container */
#mobileCards .image-zoom-container {
  position: relative;
}

#mobileCards .image-zoom {
  transition: transform 0.3s ease;
  cursor: pointer;
}

#mobileCards .image-zoom-container:hover .image-zoom {
  transform: scale(2) translateX(30px);
  z-index: 100;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Ensure proper spacing for mobile cards */
#mobileCards {
  padding-top: 10px;
  padding-bottom: 20px;
}

/* Mobile card container */
#mobileCards .rounded-xl {
  background: white;
  border: 1px solid #e2e8f0;
  margin-bottom: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

/* Mobile card title */
#mobileCards h4 {
  font-size: 14px;
  line-height: 1.4;
  margin-bottom: 8px;
}

/* Mobile card number badge */
#mobileCards .text-xs.text-gray-500 {
  font-size: 11px;
  background: #f1f5f9;
  padding: 2px 6px;
  border-radius: 4px;
  display: inline-block;
}

/* Ensure table headers have proper height for tooltips */
.sticky-head th {
  padding-top: 15px;
  padding-bottom: 15px;
}
  </style>
</head>

<body class="min-h-screen text-brand-ink" style="background: var(--bg-grad);">

  

  <!-- Image Modal -->
  <div id="imageModal" class="image-modal">
    <div class="modal-content">
      <button id="modalClose" class="modal-close">
        <i class="fas fa-times"></i>
      </button>
      <img id="modalImage" class="modal-image" src="" alt="">
      <div id="modalTitle" class="modal-title"></div>
    </div>
  </div>

  <!-- LEFT SIDEBAR - Navigation Only -->
  <aside id="sidebar"
         class="fixed top-0 left-0 h-full w-16 bg-white shadow-2xl z-50 overflow-hidden hidden">
    <div class="h-full flex flex-col py-4">
      <!-- Close button -->
      <div class="px-3 mb-6 flex justify-end">
        <button id="closeSidebar" class="sidebar-icon relative">
          <i class="fas fa-times text-lg"></i>
          <span class="sidebar-tooltip">Close</span>
        </button>
      </div>
      
      <!-- Navigation Icons -->
      <nav class="flex-1 flex flex-col space-y-2 px-3">
        <a href="#" class="sidebar-icon active relative">
          <i class="fas fa-home text-lg"></i>
          <span class="sidebar-tooltip">Dashboard</span>
          <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-1 h-8 bg-brand-blue rounded-r-md"></span>
        </a>
        
        <a href="#" class="sidebar-icon relative">
          <i class="fas fa-search text-lg"></i>
          <span class="sidebar-tooltip">Search</span>
        </a>
        
        <a href="#" class="sidebar-icon relative">
          <i class="fas fa-chart-line text-lg"></i>
          <span class="sidebar-tooltip">Analytics</span>
        </a>
        
        <a href="#" class="sidebar-icon relative">
          <i class="fas fa-box text-lg"></i>
          <span class="sidebar-tooltip">Products</span>
        </a>
        
        <a href="#" class="sidebar-icon relative">
          <i class="fas fa-cog text-lg"></i>
          <span class="sidebar-tooltip">Settings</span>
        </a>
        
        <a href="#" class="sidebar-icon relative">
          <i class="fas fa-question-circle text-lg"></i>
          <span class="sidebar-tooltip">Help</span>
        </a>
      </nav>
      
      <!-- Bottom icons -->
      <div class="px-3 mt-auto space-y-2">
        <a href="#" class="sidebar-icon relative">
          <i class="fas fa-user text-lg"></i>
          <span class="sidebar-tooltip">Profile</span>
        </a>
        
        <a href="/ai-tool" class="sidebar-icon relative">
          <i class="fas fa-robot text-lg"></i>
          <span class="sidebar-tooltip">AI Tool</span>
        </a>
      </div>
    </div>
  </aside>

  <!-- Floating handle (always visible on left edge) -->
  <button id="floatingHandle"
          class="fixed left-2 top-1/2 -translate-y-1/2 z-40 rounded-full shadow-glow bg-brand-blue text-white px-3 py-2">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Main Content -->
  <div class="ml-0 md:ml-16">
    <!-- Top Nav -->
    <header class="sticky top-0 z-40">
      <div class="glass shadow-soft">
        <div class="max-w-7xl mx-auto px-5 py-4 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <!-- SVG Logo -->
            <img src="logo.svg" alt="">
           </div>
          <div class="flex items-center gap-3">
            <!-- Back to AI tool page -->
            <a href="/ai-tool" class="group relative inline-flex items-center gap-2 rounded-xl bg-brand-blue text-white px-4 py-2 shadow-soft hover:shadow-glow transition-all">
              <svg class="w-4 h-4 opacity-80 group-hover:-translate-x-0.5 transition" viewBox="0 0 24 24" fill="none">
                <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="hidden sm:inline">Back to AI Tool</span>
              <span class="sm:hidden">AI Tool</span>
            </a>
          </div>
        </div>
      </div>
    </header>

 <div class="max-w-7xl mx-auto px-5 mt-6 mb-2">
  <div class="text-center">
    <div class="inline-flex items-center gap-3 bg-white/80 rounded-2xl px-6 py-4 shadow-soft border border-brand-blue/10">
      <!-- Icon -->
      <div class="w-10 h-10 bg-gradient-to-br from-brand-blue to-brand-navy rounded-xl flex items-center justify-center shadow-sm">
        <i class="fas fa-binoculars text-white text-lg"></i>
      </div>
      
      <!-- Title -->
      <div class="text-left">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-brand-navy to-brand-blue bg-clip-text text-transparent">
          Scouter AI Tool
        </h1>
        <p class="text-xs text-brand-ink/60 font-medium">
          AI-Powered Product Analysis
        </p>
      </div>
      
      <!-- Badge -->
      <div class="bg-brand-lime text-brand-navy px-3 py-1 rounded-full text-xs font-bold shadow-sm">
        BETA
      </div>
    </div>
  </div>
</div>

    <!-- Search Section -->
    <section class="max-w-7xl mx-auto px-5 mt-8">
      <div class="rounded-card p-6 md:p-8 bg-white/80 shadow-soft relative overflow-hidden">
        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-brand-lime/40 blur-2xl animate-float"></div>
        <div class="flex flex-col md:flex-row gap-4 items-end">
          <div class="flex-1 w-full">
            <label for="keywordSearch" class="block text-sm font-medium text-brand-navy mb-2">Search Keyword</label>
            <div class="relative">
              <input 
                type="text" 
                id="keywordSearch" 
                placeholder="Enter product keyword..." 
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-blue/60 focus:border-transparent"
                value="samsung s24 case"
              >
            </div>
          </div>
          <div class="flex gap-2">
            <button id="searchButton" class="flex items-center gap-2 rounded-xl bg-brand-blue text-white px-6 py-3 shadow-soft hover:shadow-glow transition">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
              <span class="font-medium">Search</span>
            </button>
            <button id="filterToggle" class="flex items-center gap-2 rounded-xl bg-white px-4 py-3 border border-gray-300 hover:shadow-soft transition z-50">
              <svg class="w-5 h-5 text-brand-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"/>
              </svg>
              <span class="font-medium text-brand-navy"></span>
            </button>
          </div>
        </div>
        
        <!-- Filters Panel (shown by default) -->
        <div id="filtersPanel" class="mt-6 p-5 bg-gray-50 rounded-xl">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-brand-navy mb-2">
                Rating
                <span class="filter-tooltip">
                  <i class="fas fa-info-circle text-brand-blue text-xs"></i>
                  <span class="tooltip-text">Minimum rating to filter products</span>
                </span>
              </label>
              <input type="number" min="0" max="5" step="0.1" 
                     class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue/60" 
                     placeholder="e.g. 4.0" value="" id="ratingFilter">
            </div>
            <div>
              <label class="block text-sm font-medium text-brand-navy mb-2">
                AVG Sales
                <span class="filter-tooltip">
                  <i class="fas fa-info-circle text-brand-blue text-xs"></i>
                  <span class="tooltip-text">Average daily sales volume</span>
                </span>
              </label>
              <input type="number" min="0" step="0.1"
                     class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue/60" 
                     placeholder="e.g. 1.0" value="" id="avgSalesFilter">
            </div>
            <div>
              <label class="block text-sm font-medium text-brand-navy mb-2">
                Min Profit %
                <span class="filter-tooltip">
                  <i class="fas fa-info-circle text-brand-blue text-xs"></i>
                  <span class="tooltip-text">Minimum profit percentage</span>
                </span>
              </label>
              <input type="number" min="0" 
                     class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue/60" 
                     placeholder="e.g. 75" value="" id="minProfitFilter">
            </div>
          </div>
        </div>
      </div>
    </section>

<section id="preSearchVisual" class="max-w-4xl mx-auto px-5 mt-12 mb-8">
  <div class="text-center">
    <!-- Animated Icon Container -->
    <div class="relative inline-block mb-6">
      <!-- Outer glow -->
      <div class="absolute inset-0 rounded-full bg-brand-blue/20 blur-xl animate-pulse"></div>
      
      <!-- Main icon container -->
      <div class="relative bg-white/80 rounded-2xl p-8 shadow-soft border border-brand-blue/10">
        <!-- Radar animation -->
        <div class="relative w-32 h-32 mx-auto mb-4">
          <!-- Radar circles -->
          <div class="absolute inset-0 rounded-full border-2 border-brand-blue/20"></div>
          <div class="absolute inset-4 rounded-full border-2 border-brand-blue/30"></div>
          <div class="absolute inset-8 rounded-full border-2 border-brand-blue/40"></div>
          
          <!-- Scanning line -->
          <div class="absolute top-0 left-1/2 w-1 h-full origin-bottom">
            <div class="w-1 h-full bg-gradient-to-b from-transparent via-brand-lime to-brand-blue animate-spin"></div>
          </div>
          
          <!-- Center dot -->
          <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="w-4 h-4 bg-brand-blue rounded-full shadow-glow"></div>
          </div>
        </div>
        
        <!-- Icons around radar -->
        <div class="absolute -top-2 -left-2 w-8 h-8 bg-brand-lime rounded-full flex items-center justify-center shadow-sm">
          <i class="fas fa-search text-brand-navy text-xs"></i>
        </div>
        <div class="absolute -top-2 -right-2 w-8 h-8 bg-brand-blue rounded-full flex items-center justify-center shadow-sm">
          <i class="fas fa-chart-line text-white text-xs"></i>
        </div>
        <div class="absolute -bottom-2 -left-2 w-8 h-8 bg-brand-navy rounded-full flex items-center justify-center shadow-sm">
          <i class="fas fa-bolt text-brand-lime text-xs"></i>
        </div>
        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm border border-brand-blue/20">
          <i class="fas fa-trophy text-brand-blue text-xs"></i>
        </div>
      </div>
    </div>

    <!-- Text content -->
    <div class="space-y-4">
      <h3 class="text-2xl md:text-3xl font-bold text-brand-navy">
        Ready to <span class="text-brand-lime">Discover</span> Winners?
      </h3>

      <!-- CTA Button -->
      <div class="pt-6">
        <button id="visualSearchButton" class="group relative inline-flex items-center gap-3 rounded-xl bg-brand-blue text-white px-8 py-4 shadow-soft hover:shadow-glow transition-all transform hover:scale-105">
          <i class="fas fa-play-circle text-brand-lime text-lg"></i>
          <span class="font-semibold text-lg">Start Product Analysis</span>
          <div class="absolute -inset-1 bg-brand-lime/20 rounded-xl blur-sm group-hover:blur-md transition-all -z-10"></div>
        </button>
      </div>
    </div>
  </div>
</section>

    <!-- Hero / Context (Hidden initially) -->
    <section id="heroSection" class="results-section max-w-7xl mx-auto px-5 mt-8">
      <div class="rounded-card p-6 md:p-8 bg-white/80 shadow-soft relative overflow-hidden">
        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-brand-lime/40 blur-2xl animate-float"></div>
        <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-brand-navy mb-2">
          🏆 Top Winners: <span class="text-brand-lime">"samsung s24 case"</span>
        </h1>
        <p class="text-brand-ink/70 max-w-3xl">
          <span class="mr-3">🎯 Real-Time Market Analysis</span> •
          <span class="mx-3">💯 Smart Data Processing</span> •
          <span class="mx-3">📊 Live Sales Metrics</span>
        </p>
      </div>
    </section>

    <!-- KPIs (Hidden initially) - FIXED GRID LAYOUT -->
    <section id="kpiSection" class="results-section max-w-7xl mx-auto px-5 mt-6">
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-5">
        <!-- Each card -->
        <div class="glass rounded-card p-4 md:p-5 shadow-soft animate-fadeInUp">
          <p class="text-xs uppercase tracking-wide text-brand-ink/60 flex items-center">
            Analyzed
            <span class="kpi-tooltip">
              <i class="fas fa-info-circle text-brand-blue text-xs ml-1"></i>
              <span class="tooltip-text">Total number of products analyzed in the search</span>
            </span>
          </p>
          <div id="kpiAnalyzed" class="text-2xl md:text-3xl font-extrabold text-brand-navy">0</div>
        </div>
        <div class="glass rounded-card p-4 md:p-5 shadow-soft animate-fadeInUp [animation-delay:.05s]">
          <p class="text-xs uppercase tracking-wide text-brand-ink/60 flex items-center">
            Winners Found
            <span class="kpi-tooltip">
              <i class="fas fa-trophy text-brand-lime text-xs ml-1"></i>
              <span class="tooltip-text">Number of high-profit products identified</span>
            </span>
          </p>
          <div id="kpiWinners" class="text-2xl md:text-3xl font-extrabold text-brand-navy">0</div>
        </div>
        <div class="glass rounded-card p-4 md:p-5 shadow-soft animate-fadeInUp [animation-delay:.1s]">
          <p class="text-xs uppercase tracking-wide text-brand-ink/60 flex items-center">
            Success Rate
            <span class="kpi-tooltip">
              <i class="fas fa-chart-line text-green-500 text-xs ml-1"></i>
              <span class="tooltip-text">Percentage of analyzed products that are profitable</span>
            </span>
          </p>
          <div id="kpiSuccess" class="text-2xl md:text-3xl font-extrabold text-navy-600">0%</div>
        </div>
        <div class="glass rounded-card p-4 md:p-5 shadow-soft animate-fadeInUp [animation-delay:.15s]">
          <p class="text-xs uppercase tracking-wide text-brand-ink/60 flex items-center">
            Min Profit
            <span class="kpi-tooltip">
              <i class="fas fa-money-bill-wave text-yellow-500 text-xs ml-1"></i>
              <span class="tooltip-text">Minimum profit margin of the filtered products</span>
            </span>
          </p>
          <div id="kpiMinProfit" class="text-2xl md:text-3xl font-extrabold text-navy-600">0%</div>
        </div>
        <div class="glass rounded-card p-4 md:p-5 shadow-soft animate-fadeInUp [animation-delay:.2s]">
          <p class="text-xs uppercase tracking-wide text-brand-ink/60 flex items-center">
            Data Quality
            <span class="kpi-tooltip">
              <i class="fas fa-database text-purple-500 text-xs ml-1"></i>
              <span class="tooltip-text">Quality rating of the data sources used</span>
            </span>
          </p>
          <div class="text-2xl md:text-3xl font-extrabold text-navy-500">Smart</div>
        </div>
        <div class="glass rounded-card p-4 md:p-5 shadow-soft animate-fadeInUp [animation-delay:.25s]">
          <p class="text-xs uppercase tracking-wide text-brand-ink/60 flex items-center">
            Time
            <span class="kpi-tooltip">
              <i class="fas fa-clock text-red-500 text-xs ml-1"></i>
              <span class="tooltip-text">Time taken to analyze and process the data</span>
            </span>
          </p>
          <div id="kpiTime" class="text-2xl md:text-3xl font-extrabold text-brand-navy">0s</div>
        </div>
      </div>
    </section>

    <!-- Results Section (Hidden initially) -->
    <section id="resultsSection" class="results-section max-w-7xl mx-auto px-5 mt-8 mb-24">
      <div class="rounded-card bg-white shadow-soft overflow-hidden">
        <!-- Table header -->
        <div class="px-5 py-4 border-b flex flex-col md:flex-row md:items-center md:justify-between gap-3 bg-white">
          <div>
            <h3 class="text-lg md:text-xl font-bold text-brand-navy">High-Profit Products</h3>
            <p class="text-sm text-brand-ink/60">
              Curated winners from AliExpress → eBay with 30D sales & profitability.
            </p>
          </div>
          <div class="flex items-center gap-2 w-full md:w-auto">
            <input
              id="tableSearch"
              class="px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue/60 flex-grow md:flex-grow-0"
              placeholder="Search title..."
            />
            <button
              id="exportCSV"
              class="px-4 py-2 rounded-lg bg-brand-blue text-white shadow-soft hover:shadow-glow transition whitespace-nowrap"
            >
              <i class="fas fa-download mr-2"></i>
              <span class="hidden sm:inline">Export CSV</span>
              <span class="sm:hidden">Export</span>
            </button>
          </div>
        </div>

        <!-- Desktop Table Container -->
        <div class="table-container my-4 hidden md:block">
          <div class="pretty-scroll overflow-x-auto">
            <table id="productsTable" class="w-full text-sm">
              <thead class="sticky-head">
                <tr class="bg-brand-navy text-white/90">
                  <th class="py-3 pl-5 pr-2 text-left">#</th>
                  <th class="p-3 text-left">
                    <span class="th-tooltip">
                      Product image
                      <span class="tooltip-text">Product image - click to enlarge</span>
                    </span>
                  </th>
                  <th class="p-3 text-left sortable">
                    <span class="th-tooltip">
                      Title
                      <span class="tooltip-text">Product title and description</span>
                    </span>
                  </th>
                  <th class="p-3 text-right sortable">
                    <span class="th-tooltip">
                      Ali Price
                      <span class="tooltip-text">Price on AliExpress</span>
                    </span>
                  </th>
                  <th class="p-3 text-right sortable">
                    <span class="th-tooltip">
                      eBay Price
                      <span class="tooltip-text">Selling price on eBay</span>
                    </span>
                  </th>
                  <th class="p-3 text-center sortable">
                    <span class="th-tooltip">
                      Sales (30D)
                      <span class="tooltip-text">Number of sales in the last 30 days</span>
                    </span>
                  </th>
                  <th class="p-3 text-center sortable">
                    <span class="th-tooltip">
                      Daily Avg
                      <span class="tooltip-text">Average daily sales volume</span>
                    </span>
                  </th>
                  <th class="p-3 text-center sortable">
                    <span class="th-tooltip">
                      Rating
                      <span class="tooltip-text">Customer rating (if available)</span>
                    </span>
                  </th>
                  <th class="p-3 text-center sortable">
                    <span class="th-tooltip">
                      Performance
                      <span class="tooltip-text">Sales performance indicator</span>
                    </span>
                  </th>
                  <th class="py-3 pr-5 pl-2 text-right sortable">
                    <span class="th-tooltip">
                      Profit
                      <span class="tooltip-text">Profit margin percentage</span>
                    </span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100" id="tableBody">
                <!-- Rows will be populated by JavaScript -->
              </tbody>
            </table>
          </div>
        </div>

        <!-- Mobile Cards Container -->
        <div id="mobileCards" class="md:hidden px-5 py-4 space-y-4">
          <!-- Cards will be populated by JavaScript -->
        </div>

        <!-- Pagination and Rows Per Page -->
        <div class="px-5 py-4 border-t flex flex-col md:flex-row justify-between items-center gap-4">
          <div class="flex items-center gap-3">
            <span class="text-sm text-brand-ink/70">Rows per page:</span>
            <select id="rowsPerPage" class="px-3 py-1.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue/60">
              <option value="5">5</option>
              <option value="10" selected>10</option>
              <option value="25">25</option>
              <option value="50">50</option>
            </select>
          </div>
          
          <div class="flex items-center gap-2">
            <span id="pageInfo" class="text-sm text-brand-ink/70">Page 1 of 1</span>
            <nav>
              <ul id="pagination" class="pagination">
                <!-- Pagination will be populated by JavaScript -->
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Scripts -->
  <script>
    // Sample data for products
    const products = [
      {
        id: 1,
        title: "Magnetic Flip Leather Case for Samsung S25/S24 Ultra",
        aliPrice: 6.31,
        ebayPrice: 17.55,
        sales30d: 25,
        dailyAvg: 0.8,
        rating: 4.3,
        performance: "GOOD SELLER",
        profit: 178.1,
        image: "https://images.unsplash.com/photo-1598327105666-5b89351aff97?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 2,
        title: "Luxury Vintage PU Leather Case for Samsung S25 Ultra",
        aliPrice: 2.92,
        ebayPrice: 7.89,
        sales30d: 29,
        dailyAvg: 1.0,
        rating: null,
        performance: "GOOD SELLER",
        profit: 170.4,
        image: "https://images.unsplash.com/photo-1512496015851-a90fb38ba796?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 3,
        title: "Clear Transparent Case for Samsung S24 Ultra",
        aliPrice: 3.45,
        ebayPrice: 12.99,
        sales30d: 42,
        dailyAvg: 1.4,
        rating: 4.7,
        performance: "BEST SELLER",
        profit: 276.5,
        image: "https://images.unsplash.com/photo-1556656793-08538906a9f8?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 4,
        title: "Shockproof Armor Case for Samsung S24",
        aliPrice: 4.25,
        ebayPrice: 15.75,
        sales30d: 18,
        dailyAvg: 0.6,
        rating: 4.1,
        performance: "AVERAGE",
        profit: 270.6,
        image: "https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 5,
        title: "Wallet Stand Case for Samsung S24 Ultra",
        aliPrice: 5.80,
        ebayPrice: 19.99,
        sales30d: 33,
        dailyAvg: 1.1,
        rating: 4.5,
        performance: "GOOD SELLER",
        profit: 244.7,
        image: "https://images.unsplash.com/photo-1601593346740-925612772716?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 6,
        title: "Silicone Gel Case for Samsung S24",
        aliPrice: 2.15,
        ebayPrice: 8.49,
        sales30d: 56,
        dailyAvg: 1.9,
        rating: 4.2,
        performance: "BEST SELLER",
        profit: 294.9,
        image: "https://images.unsplash.com/photo-1605236453806-6ff36851218e?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 7,
        title: "Carbon Fiber Case for Samsung S24 Ultra",
        aliPrice: 7.20,
        ebayPrice: 24.99,
        sales30d: 14,
        dailyAvg: 0.5,
        rating: 4.8,
        performance: "AVERAGE",
        profit: 247.1,
        image: "https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 8,
        title: "Waterproof Case for Samsung S24",
        aliPrice: 8.50,
        ebayPrice: 29.99,
        sales30d: 22,
        dailyAvg: 0.7,
        rating: 4.0,
        performance: "GOOD SELLER",
        profit: 252.8,
        image: "https://images.unsplash.com/photo-1574944985070-8f3ebc6b79d2?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 9,
        title: "Glitter Sparkle Case for Samsung S24",
        aliPrice: 3.75,
        ebayPrice: 13.49,
        sales30d: 47,
        dailyAvg: 1.6,
        rating: 4.6,
        performance: "BEST SELLER",
        profit: 259.7,
        image: "https://images.unsplash.com/photo-1601784551446-66c8f5c8f8b6?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 10,
        title: "Wooden Texture Case for Samsung S24 Ultra",
        aliPrice: 6.90,
        ebayPrice: 22.99,
        sales30d: 12,
        dailyAvg: 0.4,
        rating: 4.4,
        performance: "AVERAGE",
        profit: 233.2,
        image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 11,
        title: "Marble Design Case for Samsung S24",
        aliPrice: 4.60,
        ebayPrice: 16.75,
        sales30d: 38,
        dailyAvg: 1.3,
        rating: 4.3,
        performance: "GOOD SELLER",
        profit: 264.1,
        image: "https://images.unsplash.com/photo-1586953208448-b95a79798f07?q=80&w=240&auto=format&fit=crop"
      },
      {
        id: 12,
        title: "Gaming Design Case for Samsung S24 Ultra",
        aliPrice: 5.25,
        ebayPrice: 18.99,
        sales30d: 27,
        dailyAvg: 0.9,
        rating: 4.7,
        performance: "GOOD SELLER",
        profit: 261.7,
        image: "https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?q=80&w=240&auto=format&fit=crop"
      }
    ];

    // Global variables
    let currentPage = 1;
    let rowsPerPage = 10;
    let filteredProducts = [...products];
    let sortColumn = null;
    let sortDirection = 'asc';

    // Sorting functionality
    function sortTable(columnIndex) {
      if (sortColumn === columnIndex) {
        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
      } else {
        sortColumn = columnIndex;
        sortDirection = 'asc';
      }
      
      // Update table headers
      document.querySelectorAll('.sortable').forEach((th, index) => {
        th.classList.remove('asc', 'desc');
        if (index === columnIndex) {
          th.classList.add(sortDirection);
        }
      });
      
      // Sort products
      filteredProducts.sort((a, b) => {
        let aValue, bValue;
        
        // Map column indices (starting from 2 because # and Product image are not sortable)
        const columnMap = {
          2: 'title',
          3: 'aliPrice',
          4: 'ebayPrice',
          5: 'sales30d',
          6: 'dailyAvg',
          7: 'rating',
          8: 'performance',
          9: 'profit'
        };
        
        const field = columnMap[columnIndex];
        if (!field) return 0;
        
        // Handle performance field conversion
        if (field === 'performance') {
          const perfMap = { "BEST SELLER": 3, "GOOD SELLER": 2, "AVERAGE": 1 };
          aValue = perfMap[a[field]] || 0;
          bValue = perfMap[b[field]] || 0;
        } else {
          aValue = a[field];
          bValue = b[field];
        }
        
        // Handle null/undefined values
        if (aValue == null) aValue = field === 'title' ? '' : 0;
        if (bValue == null) bValue = field === 'title' ? '' : 0;
        
        if (sortDirection === 'asc') {
          return aValue > bValue ? 1 : aValue < bValue ? -1 : 0;
        } else {
          return aValue < bValue ? 1 : aValue > bValue ? -1 : 0;
        }
      });
      
      renderTable();
    }

    // Setup sorting on table headers
    function setupSorting() {
      const headers = document.querySelectorAll('.sortable');
      headers.forEach((header, index) => {
        // Add 2 to index because # and Product image columns are not sortable
        const columnIndex = index + 2;
        header.addEventListener('click', () => sortTable(columnIndex));
      });
    }

    // counter animation
    const animate = (el, end, suffix="", dur=1200) => {
      const start = 0, t0 = performance.now();
      const step = t => {
        const p = Math.min((t - t0)/dur, 1);
        el.textContent = (Math.floor(start + p*(end-start))) + suffix;
        if (p < 1) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
    };

    // Sidebar controls
    const sidebar = document.getElementById("sidebar");
    const openers = [document.getElementById("floatingHandle")].filter(Boolean);
    const closer = document.getElementById("closeSidebar");

    openers.forEach(btn => btn && btn.addEventListener("click", () => {
      sidebar.classList.toggle("hidden");
    }));
    closer.addEventListener("click", () => sidebar.classList.add("hidden"));

    // Close sidebar with ESC
    document.addEventListener("keydown", (e)=>{ if(e.key==="Escape") sidebar.classList.add("hidden"); });

    // Filter toggle
    const filterToggle = document.getElementById("filterToggle");
    const filtersPanel = document.getElementById("filtersPanel");
    
    filterToggle.addEventListener("click", (e) => {
      e.stopPropagation();
      filtersPanel.classList.toggle("hidden");
    });

    // Close filters panel when clicking outside
    document.addEventListener('click', (e) => {
      if (!filtersPanel.contains(e.target) && !filterToggle.contains(e.target)) {
        // Don't close by default, only when search is clicked
      }
    });

    // Search button functionality
    const searchButton = document.getElementById("searchButton");
    const resultsSections = document.querySelectorAll(".results-section");
    const keywordSearch = document.getElementById("keywordSearch");
    const heroSection = document.getElementById("heroSection");
    
    // Visual search button
    document.getElementById('visualSearchButton').addEventListener('click', function() {
      document.getElementById('searchButton').click();
      document.getElementById('preSearchVisual').style.display = 'none';
    });
     
    searchButton.addEventListener("click", async () => {
  // Create AbortController with 150 second timeout for long API calls
  const controller = new AbortController();
  const timeoutId = setTimeout(() => controller.abort(), 150000);

  // Timer to show elapsed time
  let elapsedSeconds = 0;
  const timerInterval = setInterval(() => {
    elapsedSeconds++;
    const searchingText = elapsedSeconds < 30
      ? `Searching... ${elapsedSeconds}s`
      : `Analyzing products... ${elapsedSeconds}s`;
    searchButton.querySelector('span').textContent = searchingText;
  }, 1000);

  try {
    searchButton.disabled = true;
    searchButton.innerHTML = `
      <svg class="animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10" stroke-opacity="0.3"></circle>
        <path d="M4 12a8 8 0 018-8"></path>
      </svg>
      <span class="font-medium">Searching... 0s</span>
    `;

    const keyword = keywordSearch.value.trim();
    if (!keyword) {
      alert('Please enter a search keyword');
      clearTimeout(timeoutId);
      clearInterval(timerInterval);
      resetSearchButton();
      return;
    }

    const ratingFilter = parseFloat(document.getElementById("ratingFilter").value) || null;
    const avgSalesFilter = parseFloat(document.getElementById("avgSalesFilter").value) || null;
    const minProfitFilter = parseFloat(document.getElementById("minProfitFilter").value) || null;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    const response = await fetch('/api/scouter-pro/search', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken || '',
      },
      body: JSON.stringify({
        keyword: keyword,
        profitMargin: 0.30,
        salesThreshold: 2,
        maxResults: 50,
        rating: ratingFilter,
        avgSales: avgSalesFilter,
        minProfit: minProfitFilter
      }),
      signal: controller.signal
    });

    clearTimeout(timeoutId);
    clearInterval(timerInterval);

    if (!response.ok) {
      const errorText = await response.text();
      console.error('Response not OK:', response.status, errorText);
      throw new Error(`Server error (${response.status}): ${errorText.substring(0, 100)}`);
    }

    const result = await response.json();

    if (!result.success) {
      throw new Error(result.message || 'Search failed');
    }

    const backendProducts = result.data?.results || result.results || [];

    if (backendProducts.length === 0) {
      alert('No products found. Try a different keyword or filters.');
      clearTimeout(timeoutId);
      clearInterval(timerInterval);
      resetSearchButton();
      return;
    }

    products.length = 0;
    products.push(...backendProducts.map((item, index) => ({
      id: index + 1,
      title: item.aliTitle || item.title || 'Unknown Product',
      aliPrice: parseFloat(item.aliPrice || 0),
      ebayPrice: parseFloat(item.ebayPrice || 0),
      sales30d: parseInt(item.ebaySales || item.sales30d || 0),
      dailyAvg: parseFloat(item.dailyAvg || 0),
      rating: item.rating ? parseFloat(item.rating) : null,
      performance: item.performance || (parseFloat(item.dailyAvg) >= 1.0 ? 'BEST SELLER' : parseFloat(item.dailyAvg) >= 0.3 ? 'GOOD SELLER' : 'AVERAGE'),
      profit: parseFloat(item.profit || 0),
      image: item.aliImage || item.ebayImage || item.image || 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?q=80&w=240&auto=format&fit=crop',
      aliUrl: item.aliUrl || '#',
      ebayUrl: item.ebayUrl || '#',
      dataSource: item.dataSource || 'unknown',
      sourceDetail: item.sourceDetail || ''
    })));

    filteredProducts = [...products];
    heroSection.querySelector("h1").innerHTML = `🏆 Top Winners: <span class="text-brand-lime">"${keyword}"</span>`;
    
    resultsSections.forEach(section => section.style.display = "block");
    document.getElementById('preSearchVisual').style.display = 'none';
    filtersPanel.classList.add("hidden");
    
    animate(document.getElementById("kpiAnalyzed"), filteredProducts.length, "");
    animate(document.getElementById("kpiWinners"), filteredProducts.length, "");
    animate(document.getElementById("kpiSuccess"), Math.round((filteredProducts.length / backendProducts.length) * 100), "%");
    
    const minProfit = filteredProducts.length > 0 ? Math.min(...filteredProducts.map(p => p.profit)) : 0;
    animate(document.getElementById("kpiMinProfit"), Math.round(minProfit), "%");
    animate(document.getElementById("kpiTime"), 124, "s");

    sortColumn = null;
    sortDirection = 'asc';
    document.querySelectorAll('.sortable').forEach(th => th.classList.remove('asc', 'desc'));
    
    currentPage = 1;
    renderTable();
    clearTimeout(timeoutId);
    clearInterval(timerInterval);
    resetSearchButton();

  } catch (error) {
    clearTimeout(timeoutId);
    clearInterval(timerInterval);
    console.error('Search error:', error);

    if (error.name === 'AbortError') {
      alert('Search timed out after 150 seconds. The AliExpress API is very slow. Please try again with a simpler keyword.');
    } else if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
      alert('Network error. Please check your internet connection and try again.');
    } else {
      alert('Search failed: ' + error.message);
    }
    resetSearchButton();
  }
});

function resetSearchButton() {
  searchButton.disabled = false;
  searchButton.innerHTML = `
    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
    </svg>
    <span class="font-medium">Search</span>
  `;
}

    // Table search functionality
    const tableSearch = document.getElementById("tableSearch");
    tableSearch.addEventListener("input", function() {
      const searchTerm = this.value.toLowerCase();
      filteredProducts = products.filter(product => 
        product.title.toLowerCase().includes(searchTerm)
      );
      currentPage = 1;
      renderTable();
    });

    // Export CSV functionality
    const exportCSV = document.getElementById("exportCSV");
    exportCSV.addEventListener("click", function() {
      // Create CSV content
      let csvContent = "ID,Title,Ali Price,eBay Price,Sales (30D),Daily Avg,Rating,Performance,Profit\n";
      
      filteredProducts.forEach(product => {
        csvContent += `${product.id},"${product.title}",${product.aliPrice},${product.ebayPrice},${product.sales30d},${product.dailyAvg},${product.rating || "No rating"},${product.performance},${product.profit}%\n`;
      });
      
      // Create download link
      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.setAttribute("href", url);
      link.setAttribute("download", "scouter_pro_products.csv");
      link.style.visibility = 'hidden';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      
      // Show success message
      alert("CSV file has been exported successfully!");
    });

    // Rows per page functionality
    const rowsPerPageSelect = document.getElementById("rowsPerPage");
    rowsPerPageSelect.addEventListener("change", function() {
      rowsPerPage = parseInt(this.value);
      currentPage = 1;
      renderTable();
    });

    // Function to get performance icon
    function getPerformanceIcon(performance) {
      switch(performance) {
        case "BEST SELLER":
          return '<div class="performance-icon performance-best" title="Best Seller"><i class="fas fa-crown"></i></div>';
        case "GOOD SELLER":
          return '<div class="performance-icon performance-good" title="Good Seller"><i class="fas fa-chart-line"></i></div>';
        case "AVERAGE":
          return '<div class="performance-icon performance-average" title="Average"><i class="fas fa-minus"></i></div>';
        default:
          return '<div class="performance-icon performance-average" title="Average"><i class="fas fa-minus"></i></div>';
      }
    }

    // Function to render table and mobile cards
    function renderTable() {
      const tableBody = document.getElementById("tableBody");
      const mobileCards = document.getElementById("mobileCards");
      
      // Clear existing content
      tableBody.innerHTML = "";
      mobileCards.innerHTML = "";
      
      // Calculate pagination
      const startIndex = (currentPage - 1) * rowsPerPage;
      const endIndex = startIndex + rowsPerPage;
      const paginatedProducts = filteredProducts.slice(startIndex, endIndex);
      const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);
      
      // Render table rows for desktop
      paginatedProducts.forEach((product, index) => {
        const rowNumber = startIndex + index + 1;
        
        // Desktop table row
        const row = document.createElement("tr");
        row.className = "hover:bg-brand-mint/40 transition";
        row.innerHTML = `
          <td class="py-3 pl-5 pr-2 font-semibold text-brand-ink/70">${rowNumber}</td>
          <td class="p-3">
            <div class="image-zoom-container">
              <img
                src="${product.image}"
                class="h-12 w-12 rounded-lg object-cover image-zoom"
                alt="${product.title}"
                data-title="${product.title}"
              />
            </div>
          </td>
          <td class="p-3 font-medium">${product.title}</td>
          <td class="p-3 text-right text-brand-navy font-semibold">$${product.aliPrice.toFixed(2)}</td>
          <td class="p-3 text-right text-brand-navy font-semibold">$${product.ebayPrice.toFixed(2)}</td>
          <td class="p-3 text-center text-brand-navy font-semibold">${product.sales30d}</td>
          <td class="p-3 text-center text-brand-navy font-semibold">${product.dailyAvg.toFixed(1)}</td>
          <td class="p-3 text-center">
            ${product.rating ? 
              `<span class="inline-flex items-center gap-1 px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-full bg-dark text-navy-700 text-xs sm:text-sm">⭐ ${product.rating}</span>` :
              `<span class="inline-flex items-center px-2 sm:px-3 py-0.5 rounded-full bg-dark text-gray-600 text-xs sm:text-sm">No rating</span>`
            }
          </td>
          <td class="p-3 text-center">
            ${getPerformanceIcon(product.performance)}
          </td>
          <td class="py-3 pr-5 pl-2 text-right font-bold text-brand-navy">+${product.profit}%</td>
        `;
        tableBody.appendChild(row);
        
        // Mobile card
        const card = document.createElement("div");
        card.className = "rounded-xl border border-gray-200 p-4 shadow-sm bg-white";
        card.innerHTML = `
          <div class="flex items-center gap-3 mb-3">
            <div class="image-zoom-container">
              <img
                src="${product.image}"
                class="h-14 w-14 rounded-lg object-cover image-zoom"
                alt="${product.title}"
                data-title="${product.title}"
              />
            </div>
            <div class="flex-1">
              <h4 class="font-semibold text-brand-navy text-sm mb-1">${product.title}</h4>
              <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">#${rowNumber}</span>
            </div>
          </div>
          <div class="mobile-card-grid">
            <div class="mobile-card-cell">
              <span class="mobile-card-label">Ali Price</span>
              <span class="mobile-card-value">$${product.aliPrice.toFixed(2)}</span>
            </div>
            <div class="mobile-card-cell">
              <span class="mobile-card-label">eBay Price</span>
              <span class="mobile-card-value">$${product.ebayPrice.toFixed(2)}</span>
            </div>
            <div class="mobile-card-cell">
              <span class="mobile-card-label">Sales (30D)</span>
              <span class="mobile-card-value">${product.sales30d}</span>
            </div>
            <div class="mobile-card-cell">
              <span class="mobile-card-label">Daily Avg</span>
              <span class="mobile-card-value">${product.dailyAvg.toFixed(1)}</span>
            </div>
            <div class="mobile-card-cell">
              <span class="mobile-card-label">Rating</span>
              <span class="mobile-card-value">${product.rating ? `⭐ ${product.rating}` : 'No rating'}</span>
            </div>
            <div class="mobile-card-cell">
              <span class="mobile-card-label">Performance</span>
              <span class="mobile-card-value">${product.performance}</span>
            </div>
            <div class="mobile-card-cell">
              <span class="mobile-card-label">Profit</span>
              <span class="mobile-card-value font-bold text-green-600">+${product.profit}%</span>
            </div>
          </div>
        `;
        mobileCards.appendChild(card);
      });
      
      // Update pagination
      updatePagination(totalPages);
    }

    // Function to update pagination
    function updatePagination(totalPages) {
      const pagination = document.getElementById("pagination");
      const pageInfo = document.getElementById("pageInfo");
      
      // Update page info
      pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
      
      // Clear existing pagination
      pagination.innerHTML = "";
      
      // Previous button
      const prevLi = document.createElement("li");
      prevLi.innerHTML = `<a href="#" class="rounded-l-lg ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}" ${currentPage === 1 ? 'onclick="return false;"' : ''}><i class="fas fa-chevron-left"></i></a>`;
      prevLi.querySelector("a").addEventListener("click", (e) => {
        e.preventDefault();
        if (currentPage > 1) {
          currentPage--;
          renderTable();
        }
      });
      pagination.appendChild(prevLi);
      
      // Page numbers
      for (let i = 1; i <= totalPages; i++) {
        const pageLi = document.createElement("li");
        pageLi.className = i === currentPage ? "active" : "";
        pageLi.innerHTML = `<a href="#">${i}</a>`;
        pageLi.querySelector("a").addEventListener("click", (e) => {
          e.preventDefault();
          currentPage = i;
          renderTable();
        });
        pagination.appendChild(pageLi);
      }
      
      // Next button
      const nextLi = document.createElement("li");
      nextLi.innerHTML = `<a href="#" class="rounded-r-lg ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''}" ${currentPage === totalPages ? 'onclick="return false;"' : ''}><i class="fas fa-chevron-right"></i></a>`;
      nextLi.querySelector("a").addEventListener("click", (e) => {
        e.preventDefault();
        if (currentPage < totalPages) {
          currentPage++;
          renderTable();
        }
      });
      pagination.appendChild(nextLi);
    }

    // Image Modal Functionality
    const imageModal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const modalTitle = document.getElementById("modalTitle");
    const modalClose = document.getElementById("modalClose");

    // Open modal when clicking on any product image
    function attachModalEvents() {
      document.querySelectorAll('.image-zoom').forEach(img => {
        img.addEventListener('click', function() {
          modalImage.src = this.src;
          modalTitle.textContent = this.getAttribute('data-title') || this.alt;
          imageModal.classList.add('active');
          document.body.style.overflow = 'hidden';
        });
      });
    }

    // Close modal when clicking close button
    modalClose.addEventListener('click', function() {
      imageModal.classList.remove('active');
      document.body.style.overflow = '';
    });

    // Close modal when clicking outside the image
    imageModal.addEventListener('click', function(e) {
      if (e.target === imageModal) {
        imageModal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && imageModal.classList.contains('active')) {
        imageModal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });

    // Initialize the application
    function init() {
      // Set initial state
      filteredProducts = [...products];
      attachModalEvents();
      setupSorting(); // Initialize sorting functionality
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', init);
  </script>
</body>
</html>
