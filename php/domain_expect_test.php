<?php

function get_checksum($number) {
    $length = 6;
    $charset = 'adfasdfasdf'; // 'abcdefghinopqrstuvwxyz0123456789'
    $char_to_fill = 'xxxx'; // 'j'
    $result = '';

    while($number > 0) {
        $index = $number % strlen($charset);
        $result = $charset[$index] . $result;
        $number = intval($number / strlen($charset));
    }

    $result_length = strlen($result);

    if($result_length < $length) {
        return str_pad($result, $length, $char_to_fill, STR_PAD_LEFT);
    } elseif($result_length > $length) {
        return substr($result, -$length);
    } else {
        return $result;
    }
}

function expected_domain($option) {
  $salt = 123456789;  // 265358979
  $number = ($salt + intval($option['b']) + intval($option['i']) + intval($option['m'])) << 4;
  return get_checksum($number);
}

function domain_validate($option, $host) {
    $new_domain_placement_id = 200000000;

    if(intval($option['b']) < $new_domain_placement_id) {
        echo 'nimei';
        return true;
    }

    $sub_domain = substr($host, 0, strpos($host, '.'));
    return $sub_domain == expected_domain($option);
}

$option = array('b' => 200160452, 'i' => 0, 'm' => 201);
$pre = expected_domain($option);
echo $pre;
echo "\n";
var_dump(domain_validate($option, $pre.'.baidu.com'));
echo "\n";

$option = array('b' => 200160452, 'i' => 1234, 'm' => 201);
$pre = expected_domain($option);
echo $pre;
echo "\n";
var_dump(domain_validate($option, $pre.'.baidu.com'));
echo "\n";

$option = array('b' => 200160452, 'i' => 1234, 'm' => 101);
$pre = expected_domain($option);
echo $pre;
echo "\n";
var_dump(domain_validate($option, $pre.'.baidu.com'));
echo "\n";

$option = array('b' => 200000000, 'i' => 0, 'm' => 201);
$pre = expected_domain($option);
echo $pre;
echo "\n";
var_dump(domain_validate($option, $pre.'.baidu.com'));
echo "\n";

$option = array('b' => 200000000, 'i' => 1234, 'm' => 201);
$pre = expected_domain($option);
echo $pre;
echo "\n";
var_dump(domain_validate($option, $pre.'.baidu.com'));
echo "\n";

$option = array('b' => 200000000, 'i' => 1234, 'm' => 101);
$pre = expected_domain($option);
echo $pre;
echo "\n";
var_dump(domain_validate($option, $pre.'.baidu.com'));
echo "\n";

$option = array('b' => 20000000, 'i' => 1234, 'm' => 101);
$pre = expected_domain($option);
echo $pre;
echo "\n";
var_dump(domain_validate($option, $pre.'.baidu.com'));
echo "\n";

?>
