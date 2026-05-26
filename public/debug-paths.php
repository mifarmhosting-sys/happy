<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>Debug Paths & Permissions</h1>";
echo "Current directory: " . __DIR__ . "<br>";
echo "Parent directory: " . dirname(__DIR__) . "<br>";

echo "<h2>Directory Listing of " . dirname(__DIR__) . "</h2>";
$files = scandir(dirname(__DIR__));
foreach ($files as $file) {
    $fullPath = dirname(__DIR__) . '/' . $file;
    echo $file . " - Permissions: " . substr(sprintf('%o', fileperms($fullPath)), -4) . " - Owner: " . fileowner($fullPath) . "<br>";
}

echo "<h2>Check if files are readable</h2>";
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    echo ".env exists!<br>";
    if (is_readable($envFile)) {
        echo ".env is readable!<br>";
        // Print first 5 lines (hiding secret values)
        $lines = file($envFile);
        echo "First 5 lines of .env:<br><pre>";
        for ($i = 0; $i < min(5, count($lines)); $i++) {
            echo htmlspecialchars(preg_replace('/APP_KEY=.*/', 'APP_KEY=HIDDEN', $lines[$i]));
        }
        echo "</pre>";
    } else {
        echo ".env is NOT readable!<br>";
    }
} else {
    echo ".env does NOT exist!<br>";
}
