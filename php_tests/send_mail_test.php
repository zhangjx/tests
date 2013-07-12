<?php

$user_msg = <<<EOF
<div>您好：</div>
<div><br></div>
<div>
    <blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;">
        <div>translation missing: cn.email_active_desc</div>
        <div><br></div>
        <div>
            <a href="http://open.admaster.com.cn/user/active/234/77b63dd2">激活账户</a>
        </div>
        <div><br></div>
        <div>或者复制下面的url到浏览器中打开：</div>
        <div><br></div>
        <div>
            <a href="http://open.admaster.com.cn/user/active/234/77b63dd2">http://open.admaster.com.cn/user/active/234/77b63dd2</a>
        </div>
    </blockquote>
</div>
EOF;

$code_msg = <<<EOF
<div>
相关id：a11972,b200138291,c1356,i0<br/>
fla名称：7 互动flash 270×240 20K以内.fla<br/>
下载地址：<a href="http://www.trackmaster.com.cn/code/upload/11972/200138291/1356/0/archive.zip">DOWNLOAD</a>
</div>
EOF;

$remind_msg = <<<EOF
<div>您好：</div>
<div><br></div>
<div>
    <blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;">
        <div>您正在使用 OpenMaster 找回密码，继续请点击：</div>
        <div><br></div>
        <div>
            <a href="http://open.admaster.com.cn/user/password/reset/272/8bade880">重置密码</a>
        </div>
        <div><br></div>
        <div>或者复制下面的url到浏览器中打开：</div>
        <div><br></div>
        <div>
            <a href="http://open.admaster.com.cn/user/password/reset/272/8bade880">http://open.admaster.com.cn/user/password/reset/272/8bade880</a>
        </div>
    </blockquote>
</div>
EOF;

$mail_list = array(
    'user' => array(
        'subject' => 'OpenMaster 激活账户',
        'message' => addslashes($user_msg),
        'to' => 'zhangjx1990@gmail.com',
        'type' => 'gmail',
    ),
    'code' => array(
        'subject' => '自动加码提示-成功',
        'message' => addslashes($code_msg),
        'to' => 'zhangjx1990@gmail.com',
        'type' => 'gmail',
    ),
    'remind' => array(
        'subject' => 'OpenMaster 找回密码',
        'message' => addslashes($remind_msg),
        'to' => 'zhangjx1990@gmail.com',
        'type' => 'gmail',
    ),
);

foreach($mail_list as $k => $v) {
    $email = json_encode($v);
    $cmd = 'curl -d \'email='.$email.'\' http:\/\/email.zhangjx.com/\?m\=email\&a\=send\&datatype\=json';
    $ret = shell_exec($cmd);
    $log = "[time] : ".time()."\n".$ret."\n\n";
    file_put_contents("./test_mail.log", $log, FILE_APPEND);
    sleep(10);
}

?>
