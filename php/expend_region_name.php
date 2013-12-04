<?php

define("CSV_FILE_ROOT", "./data/csvRegionExpend");

$col = 2;
$file_name = "ip";

function expend($col, $file_name) {
    $old_file = CSV_FILE_ROOT."/{$file_name}.csv";
    $new_file = CSV_FILE_ROOT."/{$file_name}_new.csv";

    $region_list = get_region_data();
    $region_city = $region_list['region_city'];

    $col_num = get_col_num($col);

    clear_file($new_file);

    if(!$fp = fopen($old_file, 'r')) {
        print_r("文件无法打开:$old_file");
    }

    while(!feof($fp)) {
        if(!$line = trim(fgets($fp))) continue;
        $l = explode(',', $line);
        $region_code = $l[$col_num];
        $l[] = isset($region_city[$region_code]) ? $region_city[$region_code] : '未知';
        $data = implode(',', $l) . "\n";
        save($new_file, $data);
    }
}

function get_col_num($col) {
    return max(0, intval($col - 1));
}

function save($file, $data) {
    return file_put_contents($file, $data, FILE_APPEND);
}

function clear_file($file) {
    return file_put_contents($file, '');
}

function get_region_data() {
    return require_once "./data/csvRegionExpend/regionConf.ini.php";
}

function str_to_arr($str) {
    return explode("\n", trim($str));
}

function get_csv_data($file) {
    return file_get_contents($file);
}

// note 转码写入csv
function write($data, $file_name, $fileAppend = false) {
    $str = '';
    foreach($data as $val) {
        $tmp = array();
        foreach($val as $v) {
            $tmp[] = addcslashes($v, ",");
        }
        $str .= implode(",", $tmp)."\n";
    }
    $fileAppend = $fileAppend === true ? FILE_APPEND : false;
    $str = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
    $str = (chr(255).chr(254)).$str;
    file_put_contents($file_name, $str, $fileAppend);
}

expend($col, $file_name);
?>
