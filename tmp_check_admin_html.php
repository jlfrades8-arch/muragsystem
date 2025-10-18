<?php
$u = 'http://127.0.0.1:8000/admin/adoption';
$c = file_get_contents($u);
$needle = 'Test Pet Name Via Script';
$i = strpos($c, $needle);
if ($i === false) { echo "not found\n"; exit; }
$start = max(0, $i - 80);
$len = min(200, strlen($c) - $start);
echo substr($c, $start, $len) . "\n";
