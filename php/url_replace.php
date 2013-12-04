<?php

$test = '<a href="http://track.zhangjx.org/test.php">test</a>';
$test2 = '<a href="test.php">test</a>';
$url = 'http://www.baidu.com';

function local2url($content, $baseUrl) {
    $pattern = '/((src)|(href))="((?!https?:\/\/).*?)"/is';
    $replacement = '\\1="' . $baseUrl . '/\\4"';
    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}

print_r($test);
echo "\n";
$ret = local2url($test, $url);
print_r($ret);
echo "\nxxxxxxxxxxxxxxxxxxx\n";
print_r($test2);
echo "\n";
$ret2 = local2url($test2, $url);
print_r($ret2);
?>
