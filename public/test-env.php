<?php
// Enable error display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>PHP Environment Debugger</h1>";

// 1. Check PHP version
echo "PHP Version: " . phpversion() . "<br>";

// 2. Check if .env exists and print its content
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    echo ".env file exists!<br>";
    $envContent = file_get_contents($envPath);
    echo "<pre>" . htmlspecialchars(preg_replace('/APP_KEY=.*/', 'APP_KEY=HIDDEN', $envContent)) . "</pre>";
} else {
    echo ".env file does NOT exist at $envPath<br>";
}

// 3. Check database.sqlite
$dbPath = __DIR__ . '/../database/database.sqlite';
if (file_exists($dbPath)) {
    echo "database.sqlite exists! Size: " . filesize($dbPath) . " bytes. Writeable: " . (is_writable($dbPath) ? 'Yes' : 'No') . "<br>";
} else {
    echo "database.sqlite does NOT exist at $dbPath<br>";
}

// 4. Try loading Laravel bootstrap to see the exact error
try {
    echo "Attempting to boot Laravel...<br>";
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    // Clear Laravel configuration cache programmatically
    echo "Clearing configuration cache...<br>";
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    // Clear config
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    echo "Configuration cache cleared successfully!<br>";
    
    // Check APP_DEBUG value in config
    echo "Config APP_DEBUG: " . (config('app.debug') ? 'TRUE' : 'FALSE') . "<br>";
    echo "Config APP_ENV: " . config('app.env') . "<br>";
    
    // Try running migrations
    echo "Attempting to run migrations...<br>";
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo "Migrations run successfully!<br>";
    
    echo "Attempting to run seeders...<br>";
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
    echo "Seeding completed successfully!<br>";
    
    echo "<h2>Laravel database setup finished!</h2>";
    
} catch (\Throwable $e) {
    echo "<h2>Error Booting/Migrating Laravel:</h2>";
    echo "Message: " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "File: " . htmlspecialchars($e->getFile()) . " (Line: " . $e->getLine() . ")<br>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
