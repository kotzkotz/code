<?php

set_time_limit(0);

//验证码地址
$url = 'http://my.en.china.cn/captcha.php';
$cookie_file = $_GET['str'];



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
$return  = curl_exec($ch);
curl_close($ch);


echo $return;






?>