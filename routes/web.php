<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\toolsController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\EbayCalculatorController;
use App\Http\Controllers\PageBackupController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TitleBuilderController;



#home page route
Route::get("/", function(){
    $home_page= new PagesController;
    return $home_page->show('index');
});

Route::get('/index', function () {
    return redirect('/');
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('edit-html/{id}', [PagesController::class, 'editHtml'])->name('pages.edit-html');
    Route::post('edit-html/{id}', [PagesController::class, 'storeHtml'])->name('pages.store-html');
    Route::resource('pages', PagesController::class);
    Route::get('pages-backup/{view_name}', [PageBackupController::class,'index'])->name('pages.backup.index');
    Route::get('pages-backup/{view_name}/preview/{id}/{base}', [PageBackupController::class,'preview'])->name('pages.backup.preview')->whereIn('base',['from','to','side-by-side']);
    Route::post('pages-backup/{view_name}/restore/{id}/{base}', [PageBackupController::class,'restore'])->name('pages.backup.restore')->whereIn('base',['from','to']);

    Route::prefix('themes')->name('themes.')->group(function () {
        Route::get('/', [ThemeController::class, 'index'])->name('index');
        Route::get('{file}/edit', [ThemeController::class, 'edit'])->name('edit');
        Route::post('{file}/store', [ThemeController::class, 'store'])->name('store');
        Route::get('{file}/history', [ThemeController::class, 'history'])->name('history');
        Route::get('{file}/show', [ThemeController::class, 'show'])->name('show');
        Route::post('{file}/restore/{id}', [ThemeController::class, 'restore'])->name('restore');

        Route::get('header/history', [ThemeController::class, 'history'])->name('header.history');
        Route::get('header/edit', [ThemeController::class, 'editHeader'])->name('header.edit');
        Route::get('footer/history', [ThemeController::class, 'history'])->name('footer.history');
        Route::get('footer/edit', [ThemeController::class, 'editFooter'])->name('footer.edit');
    });

});

// sitemap
Route::group(['prefix' => 'sitemap'], function () {
    Route::get('blog-sitemap.xml', [BlogController::class, 'sitemap'])->name('pages.sitemap'); // Pages sitemap
    Route::get('/sitemap.xml', function() {
    return Response::file(public_path('sitemap.xml'), [
        'Content-Type' => 'application/xml'
    ]);
});

});



// Authentication Routes For Admin
Route::get('admin/site/login', [LoginController::class, 'showLoginForm'])->name('Adminlogin');
Route::post('admin/site/login', [LoginController::class, 'login'])->name('Adminlogin');

Route::get('/login', function () {
    return redirect('https://app.dropshippingscout.com/login');
});
Route::get('/register', function () {
    return redirect('https://app.dropshippingscout.com/register');
});

Route::get('/pricing', function () {
    return redirect('https://app.dropshippingscout.com/pricing');
});
//Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//Route::post('register', [RegisterController::class, 'register']);
// Route::get('new-password', function () {
//     return view('new-password');
// });

// Blog Routes
// User routes
Route::get('/blogs', [BlogController::class, 'userIndex'])->name('blogs.userIndex'); // Show all blogs
Route::get('/tutorial', [BlogController::class, 'userTutorial'])->name('blogs.userTutorial'); // Show all blogs
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::post('/blogs/{id}/like', [BlogController::class, 'like'])->name('blogs.like');


Route::fallback(function () {
    // Render custom 404 view
    return response()->view('404', [], 404);
});



// Admin routes
Route::get('/admin/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/admin/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/admin/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/admin/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/admin/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');



// FAQ Routes
Route::get('faqs', [FaqController::class, 'userIndex'])->name('faqs');
Route::prefix('admin/faqs')->name('admin.faqs.')->group(function () {
    Route::get('index', [FaqController::class, 'adminIndex'])->name('index');
    Route::get('create', [FaqController::class, 'create'])->name('create');
    Route::post('', [FaqController::class, 'store'])->name('store');
    Route::get('{faq}/edit', [FaqController::class, 'edit'])->name('edit');
    Route::put('{faq}', [FaqController::class, 'update'])->name('update');
    Route::delete('{faq}', [FaqController::class, 'destroy'])->name('destroy');
});


// tools pages
Route::get('/Suppliers-Scouting/{slug}', [toolsController::class, 'show'])->name('tools-supplier.show');
Route::get('/competitor-monitoring/{slug}', [toolsController::class, 'show'])->name('tools-competitor.show');
Route::get('/product-scouting/{slug}', [toolsController::class, 'show'])->name('tools-product.show');

// Route for index page to list all tools
Route::get('/admin/tools', [toolsController::class, 'index'])->name('tools.index');
Route::get('/admin/tools/create', [toolsController::class, 'create'])->name('tools.create');
Route::post('/admin/tools', [toolsController::class, 'store'])->name('tools.store');
Route::get('/admin/tools/{tool}/edit', [toolsController::class, 'edit'])->name('tools.edit');
Route::put('/admin/tools/{tool}', [toolsController::class, 'update'])->name('tools.update');
Route::delete('/admin/tools/{tool}', [toolsController::class, 'destroy'])->name('tools.destroy');

// ebay calculator
Route::post('/calculate-fees', [EbayCalculatorController::class, 'calculate']);
// SmartTitles
Route::post('/search-title', [TitleBuilderController::class, 'searchTitle'])->name('search-title');


// Ebay calculator
Route::get('ebay-calculator', [EbayCalculatorController::class, 'index'])->name('ebay-calculator');
Route::group(['prefix'=>'calculator'], function() {
    Route::get('/' , [EbayCalculatorController::class, 'index'])->name('calculator');
    Route::get('usa',[EbayCalculatorController::class, 'index'])->name('calculator.index');
    Route::get('uk', [EbayCalculatorController::class, 'uk'])->name('calculator.uk');
    Route::get('au', [EbayCalculatorController::class, 'au'])->name('calculator.au');
    Route::get('ca', [EbayCalculatorController::class, 'ca'])->name('calculator.ca');
    Route::get('de', [EbayCalculatorController::class, 'de'])->name('calculator.de');
    Route::get('fr', [EbayCalculatorController::class, 'fr'])->name('calculator.fr');
    Route::get('it', [EbayCalculatorController::class, 'it'])->name('calculator.it');

    Route::post('usa', [EbayCalculatorController::class, 'calculateFees'])->name('calculator.calculateFees');
    Route::post('uk', [EbayCalculatorController::class, 'ukFees'])->name('calculator.uk.search');
    Route::post('au', [EbayCalculatorController::class, 'auFees'])->name('calculator.au.search');
    Route::post('ca', [EbayCalculatorController::class, 'caFees'])->name('calculator.ca.search');
    Route::post('de', [EbayCalculatorController::class, 'deFees'])->name('calculator.de.search');
    Route::post('fr', [EbayCalculatorController::class, 'frFees'])->name('calculator.fr.search');
    Route::post('it', [EbayCalculatorController::class, 'itFees'])->name('calculator.it.search');
});




// Dynamic Page Route
Route::get('/{slug}', [PagesController::class, 'show'])->name('pages.show');
