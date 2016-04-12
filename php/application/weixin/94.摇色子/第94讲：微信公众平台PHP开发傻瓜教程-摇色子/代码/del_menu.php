<?php

$appid="wx7ced2a8593275753";//填写appid
$secret="71f475563d00103a356943875e96d43a";//填写secret
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$token = $strjson->access_token;//获取token
$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$token}"; //删除菜单 
$ch = curl_init();//新建curl
curl_setopt($ch, CURLOPT_URL, $url);
curl_exec($ch); //输出   
curl_close($ch); 

?>