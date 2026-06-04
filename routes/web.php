<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHotelController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\AdminBlogController;

// Public Frontend Routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home']);
Route::get('/our-hotels.html', [HomeController::class, 'hotels'])->name('hotels');
Route::get('/destinations.html', [HomeController::class, 'destinationsPage'])->name('destinations');
Route::get('/benefits.html', [HomeController::class, 'benefits'])->name('benefits');
Route::get('/awards.html', [HomeController::class, 'awards'])->name('awards');
Route::get('/about.html', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [HomeController::class, 'blogShow'])->name('blog.show');
Route::get('/contact-us.html', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact-us.html', [HomeController::class, 'contactSubmit'])->name('contact.submit');

// Legacy routing compatibility support
Route::get('/home.html', [HomeController::class, 'home']);

// Admin Authentication Routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Secure CMS Dashboard Area
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Core Dashboard & Messages
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/messages/{id}', [AdminController::class, 'viewMessage'])->name('admin.messages.view');
    Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('admin.messages.delete');
    
    // Section Contents
    Route::get('/settings', [AdminController::class, 'editSettings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    
    Route::get('/homepage', [AdminController::class, 'editHomepage'])->name('admin.homepage');
    Route::post('/homepage', [AdminController::class, 'updateHomepage'])->name('admin.homepage.update');
    
    Route::get('/about', [AdminController::class, 'editAbout'])->name('admin.about');
    Route::post('/about', [AdminController::class, 'updateAbout'])->name('admin.about.update');

    // Hotels CRUD
    Route::resource('hotels', AdminHotelController::class, ['names' => 'admin.hotels']);

    // Destinations Management
    Route::get('/destinations', [AdminContentController::class, 'destinationsIndex'])->name('admin.destinations.index');
    Route::post('/destinations', [AdminContentController::class, 'destinationStore'])->name('admin.destinations.store');
    Route::get('/destinations/{id}/edit', [AdminContentController::class, 'destinationEdit'])->name('admin.destinations.edit');
    Route::put('/destinations/{id}', [AdminContentController::class, 'destinationUpdate'])->name('admin.destinations.update');
    Route::delete('/destinations/{id}', [AdminContentController::class, 'destinationDestroy'])->name('admin.destinations.destroy');

    // Testimonials Management
    Route::get('/testimonials', [AdminContentController::class, 'testimonialsIndex'])->name('admin.testimonials.index');
    Route::post('/testimonials', [AdminContentController::class, 'testimonialStore'])->name('admin.testimonials.store');
    Route::get('/testimonials/{id}/edit', [AdminContentController::class, 'testimonialEdit'])->name('admin.testimonials.edit');
    Route::put('/testimonials/{id}', [AdminContentController::class, 'testimonialUpdate'])->name('admin.testimonials.update');
    Route::delete('/testimonials/{id}', [AdminContentController::class, 'testimonialDestroy'])->name('admin.testimonials.destroy');

    // Benefits Management
    Route::get('/benefits', [AdminContentController::class, 'benefitsIndex'])->name('admin.benefits.index');
    Route::post('/benefits', [AdminContentController::class, 'benefitStore'])->name('admin.benefits.store');
    Route::get('/benefits/{id}/edit', [AdminContentController::class, 'benefitEdit'])->name('admin.benefits.edit');
    Route::put('/benefits/{id}', [AdminContentController::class, 'benefitUpdate'])->name('admin.benefits.update');
    Route::delete('/benefits/{id}', [AdminContentController::class, 'benefitDestroy'])->name('admin.benefits.destroy');

    // Awards & Achievements Management
    Route::get('/awards', [AdminContentController::class, 'awardsIndex'])->name('admin.awards.index');
    Route::post('/awards', [AdminContentController::class, 'awardStore'])->name('admin.awards.store');
    Route::get('/awards/{id}/edit', [AdminContentController::class, 'awardEdit'])->name('admin.awards.edit');
    Route::put('/awards/{id}', [AdminContentController::class, 'awardUpdate'])->name('admin.awards.update');
    Route::delete('/awards/{id}', [AdminContentController::class, 'awardDestroy'])->name('admin.awards.destroy');

    // Metric Stats Management
    Route::post('/stats', [AdminContentController::class, 'statStore'])->name('admin.stats.store');
    Route::get('/stats/{id}/edit', [AdminContentController::class, 'statEdit'])->name('admin.stats.edit');
    Route::put('/stats/{id}', [AdminContentController::class, 'statUpdate'])->name('admin.stats.update');
    Route::delete('/stats/{id}', [AdminContentController::class, 'statDestroy'])->name('admin.stats.destroy');

    // Member Management
    Route::resource('members', AdminMemberController::class, ['names' => 'admin.members']);

    // Blog Posts CRUD
    Route::resource('blogs', AdminBlogController::class, ['names' => 'admin.blogs']);
});

// Member Routing Groups
use App\Http\Controllers\MemberAuthController;
use App\Http\Controllers\MemberBookingController;

Route::prefix('member')->group(function () {
    Route::get('/login', [MemberAuthController::class, 'showLogin'])->name('member.login');
    Route::post('/login', [MemberAuthController::class, 'login'])->name('member.login.submit');
    Route::get('/register', [MemberAuthController::class, 'showRegister'])->name('member.register');
    Route::post('/register', [MemberAuthController::class, 'register'])->name('member.register.submit');

    Route::middleware(['auth:member'])->group(function () {
        Route::post('/logout', [MemberAuthController::class, 'logout'])->name('member.logout');
        Route::get('/profile', [MemberBookingController::class, 'profile'])->name('member.profile');
        Route::get('/booking', [MemberBookingController::class, 'showBookingForm'])->name('member.booking');
        Route::post('/booking', [MemberBookingController::class, 'storeBooking'])->name('member.booking.submit');
    });
});

// Deployment helper route to run migrations and seed database without SSH
Route::get('/run-migrations', function() {
    try {
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if ($dbPath && !file_exists($dbPath)) {
                $dir = dirname($dbPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                touch($dbPath);
            }
        }
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        return 'Migrations and Seeding completed successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/storage-link', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Storage link created successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/clear-cache', function() {
    try {
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if ($dbPath && !file_exists($dbPath)) {
                $dir = dirname($dbPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                touch($dbPath);
            }
        }
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        return 'Cache cleared successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/list-tables', function() {
    try {
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if ($dbPath && !file_exists($dbPath)) {
                $dir = dirname($dbPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                touch($dbPath);
            }
        }
        $tables = \Illuminate\Support\Facades\DB::select("SELECT name FROM sqlite_master WHERE type='table';");
        return response()->json($tables);
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/test-db', function() {
    try {
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if ($dbPath && !file_exists($dbPath)) {
                $dir = dirname($dbPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                touch($dbPath);
            }
        }
        $path = config('database.connections.sqlite.database');
        return response()->json([
            'default' => config('database.default'),
            'sqlite_path' => $path,
            'db_exists' => file_exists($path),
            'db_size' => file_exists($path) ? filesize($path) : 0,
        ]);
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

