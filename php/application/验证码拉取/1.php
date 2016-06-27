<?php

set_time_limit(0);

//验证码地址
$url = 'http://www.ec51.com/vcode.html';
$cookie_file = $_GET['str'];



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
$return  = curl_exec($ch);
$headerSize = curl_getinfo($ch,CURLINFO_HEADER_SIZE);
curl_close($ch);


$str = substr($return,0,$headerSize);
$mode = '/Content-Type: (.*)'.PHP_EOL.'/U';
preg_match_all($mode,$str,$type);


header($type[0][0]);
echo substr($return,$headerSize);






?>