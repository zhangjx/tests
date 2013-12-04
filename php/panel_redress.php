<?php

# panel 加和不等与1的情况下做趋于1的整数化处理
$panel = require_once './data/panel.php';
$panel_arr = json_decode(urldecode($panel), true);

print_r($panel_arr);

function panel_redress($panel_arr) {
    $ret = array();
    foreach($panel_arr as $k => $v) {
        if(is_array($v)) {
            $ret[$k] = redress($v);
        } else {
            $ret[$k] = $v;
        }
    }
    return $ret;
}

function redress($data) {
    $ret = array();
    $sum = array_sum($data);
    if($sum == 1) return $data;
    $m = 1/$sum;
    foreach($data as $k => $v) {
        $ret[$k] = $v * $m;
    }
    return $ret;
}

$ret = panel_redress($panel_arr);

print_r($ret);
?>
