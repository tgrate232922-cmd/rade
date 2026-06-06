<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<h1>Super Cache Clear</h1>";

// Delete cached files
$files = ['bootstrap/cache/routes-v7.php', 'bootstrap/cache/config.php'];
foreach ($files as $file) {
    $path = __DIR__.'/'.$file;
    if (file_exists($path)) {
        unlink($path);
        echo "<p>✓ Deleted: $file</p>";
    }
}

// Clear caches
$kernel->call('route:clear');
$kernel->call('config:clear');
$kernel->call('cache:clear');
$kernel->call('view:clear');

echo "<h2>Testing Route:</h2><pre>";
$route = \Route::getRoutes()->getByName('user.notification.mark-all-read-get');
if ($route) {
    echo "✓ Route EXISTS: " . $route->uri();
} else {
    echo "✗ Route NOT FOUND!";
}
echo "</pre>";

echo "<h2 style='color:red'>DELETE THIS FILE NOW!</h2>";