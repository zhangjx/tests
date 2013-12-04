<?php

$tmp = array(
    //basic and freq dim
    'mediaid',//35739
    'spotid',//26386
    'camp',//24335
    'ym',//18158 + 1028
    'freq',//10529
    'region',//7520 (region1 //1829)
    'creativeid',//2024
    'keyword',//212

    //basic and freq matrics
    'distClick',//15384
    'click',//17773
    'distView',//19843
    'view',//22603
    'ipView',//518
    'ipViewCount',//518
    'ipClick',//522
    'ipClickCount',//522
    'satuView',//1001
    'satuClick',//117
    'distvBc',//375
    'vBc',//375
    'distcBv',//393
    'cBv',//393

    //panel
    'panel',//470
    'ta',//37

    //overlap
    'over',//1137
    'over-1,over-2,over-3,uniqByCookie',//21
    'over-2,over-2,uniqByCookie',//532
    'over-1,uniqByCookie',//584
);


$sql_tmp = "SELECT COUNT(*) FROM `sp_cmdTask` WHERE `cols` LIKE '%%s%';";

foreach($tmp as $v) {
    $sql = str_replace('%s', $v, $sql_tmp);
    print_r($sql);
    echo "\n";
}




/*
// note 所有指标对应的列信息字段
$colConf = array(
    'basic' => array(
        'view' => '{#groupBy},view',
        'click' => '{#groupBy},click',
        'distView' => '{#groupBy},distView,view',
        'distClick' => '{#groupBy},distClick,click',
        'ipView' => '{#groupBy},ipView,ipViewCount',
        'ipClick' => '{#groupBy},ipClick,ipClickCount',
        'satuView' => '{#groupBySatu},{#timeType},satuView',
        'satuClick' => '{#groupBySatu},{#timeType},satuClick',
    ),
    'freq' => array(
        'view' => 'freq,{#groupByFreq},distView,view',
        'distView' => 'freq,{#groupByFreq},distView,view',
        'click' => 'freq,{#groupByFreq},click,clickCount',
        'distClick' => 'freq,{#groupByFreq},distClick,click',
        'vBc' => 'freq,{#groupByFreq},distvBc,vBc',
        'distvBc' => 'freq,{#groupByFreq},distvBc,vBc',
        'cBv' => 'freq,{#groupByFreq},distcBv,cBv',
        'distcBv' => 'freq,{#groupByFreq},distcBv,cBv',
        'distViewNoDim' => 'freq,distView,view',
        'distClickNoDim' => 'freq,distClick,click',
        'distvBcNoDim' => 'freq,distvBc,vBc',
        'distcBvNoDim' => 'freq,distcBv,cBv',
    ),
    'overlap' => array(
        'between' => 'over-1,over-2,uniqByCookie',
        '3p' => 'over-1,over-2,over-3,uniqByCookie',
        'list' => 'over-1,uniqByCookie',
    ),
    'panel' => array(
        'panel' => '{#groupBy},num,panel',
        'panelTa' => '{#groupBy},num,ta',
        'panelNoDim' => 'num,panel',
        'panelTaNoDim' => 'num,ta',
    ),
);
 */
?>
