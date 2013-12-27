<?php

// 获取所有地域的map arr
function get_all_geo_map_arr($file) {
    $arr = array();
    $all_geo_map = file($file);

    foreach($all_geo_map as $line) {
        $line = trim($line);
        if(!strpos($line, ',')) continue;
        list($name, $new_id, $old_id) = explode(',', $line);
        $arr[$name] = array('new_id' => $new_id, 'old_id' => $old_id);
    }
    return $arr;
}

// 获取新的地域map
function get_new_databank_geo_map($all_geo_file, $old_geo_file) {
    $ret = array();

    $all_geo_map = get_all_geo_map_arr($all_geo_file);
    //print_r($all_geo_map);

    $old_geo_map = file($old_geo_file);
    foreach($old_geo_map as $line) {
        $line = trim($line);
        if(!strpos($line, ',')) {
            $ret[] = "$line\n";
            continue;
        }

        list($name, $id) = explode(',', $line);
        if(isset($all_geo_map[$name])) {
            $new_geo_id = $all_geo_map[$name]['new_id'];
            $ret[] = "$name,$new_geo_id\n";
        }
    }
    return $ret;
}

// 数据写入文件
function data_to_file($file_name, $data) {
    // clear file
    //file_put_contents($file_name, '');
    file_put_contents($file_name, $new_geo_map);
}

$old_geo_file = './data/databank_old_geo_map.csv';
$all_geo_file = './data/geo_map_all.csv';
$new_geo_file = './data/databank_new_geo_map.csv';

$new_geo_map = get_new_databank_geo_map($all_geo_file, $old_geo_file);
data_to_file($new_geo_file, $new_geo_map);
print_r($new_geo_map);


?>
