<?php
/****
燕十八 公益PHP讲堂

论  坛: http://www.zixue.it
微  博: http://weibo.com/Yshiba
YY频道: 88354001
****/


/***
用户登陆页面
***/

define('ACC',true);
require('./include/init.php');


if(isset($_POST['act'])) {
    // 这说明是点击了登陆按钮过来的
    // 收用户名/密码,验证....

    $u = $_POST['username'];
    $p = $_POST['passwd'];

    // 合法性检测,自己做...


    $user = new UserModel();
    
    // 核对用户名,密码
    $row = $user->checkUser($u,$p);
    if(empty($row)) {
        $msg = '用户名密码不匹配!';
    } else {
        $msg = '登陆成功!';
        $_SESSION = $row;

        if(isset($_POST['remember'])) {
            setcookie('remuser',$u,time()+14*24*3600);
        } else {
            setcookie('remuser','',0);
        }


    }

    include(ROOT . 'view/front/msg.html');
    exit;


} else {

    $remuser = isset($_COOKIE['remuser'])?$_COOKIE['remuser']:'';

    // 准备登陆
    include(ROOT . 'view/front/denglu.html');
}

