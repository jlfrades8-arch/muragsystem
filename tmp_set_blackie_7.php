<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rescue;
$r = Rescue::find(7);
if (!$r) { echo "rescue 7 not found\n"; exit; }
$r->pet_name = 'Blackie';
$r->save();
echo "updated id=7 pet_name=".$r->pet_name."\n";
