<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rescue;
$rows = Rescue::all();
foreach ($rows as $r) {
    echo $r->id . ' : ' . ($r->image ?? '<no image>') . PHP_EOL;
}
