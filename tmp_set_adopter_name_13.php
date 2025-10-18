<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rescue;
$r = Rescue::find(13);
if (!$r) { echo "not found\n"; exit; }
$r->adopter_name = 'Maria Santos';
$r->adopter_email = 'user@gmail.com';
$r->save();
echo "updated id=13 adopter_name\n";
