<?php

include('./include/simple_html_dom.php');

# max map value
define('MAX_MAP', 1000);
# jobtracker uri
$url = 'http://xxxx/jobtracker.jsp';
# default file path
$file_path = "./job_ids.csv";

function get_job_id($url) {
  $data = array();

  # get DOM from URL or file
  $html = file_get_html($url);
  # get table
  $table = $html->find('table', 2);
  # find all td tags with attribite align=center
  foreach($table->find('tr') as $tr) {
    $map = (int)$tr->children(5)->innertext;
    if($map && $map >= MAX_MAP) {
      $job_id = $tr->children(0)->children(0)->innertext;
      $data[] = array('map' => $map, 'job_id' => $job_id);
    }
  }

  return $data;
}

function clear_file($file_path) {
  file_put_contents($file_path, '');
}

function save_file($data, $file_path) {
  if(!$data) return;
  foreach($data as $v) {
    file_put_contents($file_path, $v['job_id'], FILE_APPEND);
  }
}

function save_job_id($url, $file_path) {
  $data = get_job_id($url);
  clear_file($file_path);
  save_file($data, $file_path);
}

save_job_id($url, $file_path);

?>