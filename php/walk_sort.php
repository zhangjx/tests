<?php

$a = array (
  'overlapMethod' => '',
  'campIds' => '10215',
  'dateRange' =>
  array (
    'type' => 'relative',
    'relative' =>
    array (
      'value' => 'yesterday',
    ),
  ),
  'dims' =>
  array (
    'campaign' =>
    array (
      'switch' => 'yes',
      'values' =>
      array (
        0 => 'id',
        1 => 'name',
      ),
    ),
    'nwMedia' =>
    array (
      'switch' => 'yes',
      'values' =>
      array (
        0 => 'id',
        1 => 'name',
      ),
    ),
  ),
  'metrics' =>
  array (
    'sex' => 'yes',
    'age' => 'yes',
  ),
  'overlapBody' =>
  array (
  ),
  'citys' =>
  array (
  ),
  'without' =>
  array (
    'media' => '',
    'placement' => '',
    'channel' => '',
    'creative' => '',
  ),
  'type' => 'panel',
  'name' => '人口属性_2012-05-30_3877',
);

function muti_sort($arr) {
    if(!$arr || !is_array($arr)) return $arr;
    ksort($arr);
    foreach($arr as $key => $val) {
        if(is_array($val) && $val) {
            ksort($val);
            $arr[$key] = muti_sort($val);
        }
    }
    return $arr;
}
print_r($a);
$b = muti_sort($a);
print_r($b);
?>
