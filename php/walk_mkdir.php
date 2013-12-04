<?php

$root = realpath(dirname(__FILE__));
$path = "test/test2/test3";
//mkdir('test/test2/test3', 0777, true);

$arr = explode('/', $path);
$new = array();
$s = '';
foreach($arr as $v) {
    $s .= '/'.$v;
    $new[] = $root.$s;
    chmod($root.$s, 0777);
}

print_r($arr);
print_r($new);

?>
