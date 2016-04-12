<?php
//获取token
include ("token.php");
//创建分组 佛山
$post='{"group":{"name":"foshan"}}';
$url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token={$token}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);//url
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_exec($ch);   
curl_close($ch); 



?>



