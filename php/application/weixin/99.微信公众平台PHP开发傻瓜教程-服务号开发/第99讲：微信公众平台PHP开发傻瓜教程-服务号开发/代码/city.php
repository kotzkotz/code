<?php
include("token.php");
$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid={$fromUsername}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$city=$strjson->city;//获取城市
?>
