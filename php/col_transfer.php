<?php
#行数据 转换为二维的列数据
require_once "./config.inc.php";

function getData($file) {
    $ret = array();
    if(!$fp = fopen($file, 'r')) {
        echo("文件无法打开:$file");
    }
    while(!feof($fp)) {
        if(!$line = trim(fgets($fp))) continue;
        $l = explode(',', $line);
        $ret[] = $l;
    }
    return $ret;
}

function transfer($data) {
    $ret = array();
    foreach($data as $k => $v) {
        $ret[$v[0]][$v[1]] = $v[2];
    }
    $keys = array_keys($ret);
    foreach($ret as $key => $val) {
        foreach($keys as $k) {
            if(!array_key_exists($k, $val)) {
                $ret[$key][$k] = $ret[$k][$key];
            }
        }
    }
    return $ret;
}

function output($data) {
    $ret = '';
    if(is_array($data)) ksort($data);
    foreach($data as $k => $v) {
        if(is_array($v)) ksort($v);
        $ret .= "{$k},".implode(',', $v)."\n";
    }
    return $ret;
}

function save($s, $file) {
    file_put_contents($file, "$s", FILE_APPEND);
}

function testExec() {
    $filePath = DATA_DIR."/col_transfer/test.csv";
    $output = DATA_DIR."/col_transfer/output.csv";
    $data = getData($filePath);
    $newData = transfer($data);
    $str = output($newData);
    save($str, $output);
}

$a = testExec();

?>
