<?php

// 地域按照标准库合并
$region = require_once './data/region_merge/regionConf.ini.php';
$file = './data/region_merge/geoid_2.csv';
$citys = $region['region_city'];
$new = array();

if(!$fp = fopen($file, 'r')) print_r("文件无法打开:$file");

while(!feof($fp)) {
    if(!$line = trim(fgets($fp))) continue;
    $l = explode(',', $line);
    if(isset($citys[$l[2]])) {
        continue;
    } else {
        $new[$l[2]] = $l[0];
    }
}

var_export($new);
?>
