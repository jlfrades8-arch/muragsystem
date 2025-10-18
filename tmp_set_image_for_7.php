<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rescue;
$r = Rescue::find(7);
if (!$r) { echo "rescue 7 not found\n"; exit; }
$r->image = 'rescues/V9zVpVRYNY8CfKSZnDpYJIbT3Bl0tSpi674XkTMU.jpg';
$r->save();
echo "updated rescue 7 image to: " . $r->image . "\n";
