<?php
$c = file_get_contents('http://127.0.0.1:8000/admin/adoption');
if (strpos($c, 'Rescued') !== false) echo "found\n"; else echo "not found\n";
