<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rescue;

$rows = Rescue::all();
foreach ($rows as $r) {
    echo "id={$r->id} | status={$r->status} | image={$r->image}\n";
}
