<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Adoption;
foreach(Adoption::with('rescue')->get() as $a) {
    echo "id={$a->id} rescue_id={$a->rescue_id} adopter_name={$a->adopter_name} adopter_email={$a->adopter_email} adopted_at={$a->adopted_at}\n";
}
