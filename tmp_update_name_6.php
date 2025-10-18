<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rescue;
$r = Rescue::find(6);
if (!$r) { echo "not found\n"; exit; }
$r->full_name = 'Test Pet Name Via Script';
$r->save();
echo "updated id=6 name=".$r->full_name."\n";
