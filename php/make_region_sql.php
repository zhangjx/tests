<?php

$region = require_once "./data/region_merge/regionConf.ini.php";
$new_file = "./data/region.sql";

$sql = "INSERT INTO `geos` (
            `code`,
            `name`,
            `type`
        )
        VALUES %s;";

$sqlParts = array();
foreach ($region['region_city'] as $k => $v) {
    $sqlParts[] = "(".trim($k).", '". trim($v)."', 'region_cn')";
}

file_put_contents($new_file, sprintf($sql, implode(",\n", $sqlParts)));

?>
