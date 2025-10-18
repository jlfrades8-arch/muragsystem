<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rescue;
$r = Rescue::find(12);
if (!$r) { echo "not found\n"; exit; }
$r->status = 'Adopted';
$r->adopter_email = 'user@gmail.com';
$r->adopter_name = 'John Doe';
$r->save();
echo "simulated adopt id=12 with name\n";
