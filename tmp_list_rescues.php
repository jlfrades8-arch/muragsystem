<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$res = App\Models\Rescue::all();
foreach ($res as $r) {
    echo "{$r->id}: {$r->full_name} ({$r->status})\n";
}
if ($res->isEmpty()) echo "<no rescues>\n";
