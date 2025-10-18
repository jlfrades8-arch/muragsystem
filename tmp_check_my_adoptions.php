<?php
$c = file_get_contents('http://127.0.0.1:8000/my-adoptions');
file_put_contents('tmp_my_adoptions.html', $c);
echo "wrote tmp_my_adoptions.html\n";
