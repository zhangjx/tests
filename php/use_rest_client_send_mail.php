<?php

require dirname(__FILE__).'/include/rest_client.php';

$token = '83b545f7f6453e6f401dde885282ce8289fd4841';
$url = '/mails?access_token='.$token;
$client = new RestClient('http://mail.api.com', 'json');
$data = array(
    'from' => "opennimei@test.com.cn",
    'from_user_id' => 1,
    'to' => "zhangjx1990@gmail.com",
    'subject' => "test ni mei",
    'message' => "test nimei body "
);

$ret = json_decode($client->post($url, json_encode($data)), true);
print_r($ret);
