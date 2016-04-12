<?php
//获取token

$appid="";//填写appid
$secret="";//填写secret
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$token = $strjson->access_token;

//临时二维码，修改过期时间,最大1800
$post='{"expire_seconds": 120,"action_name": "QR_SCENE","action_info": {"scene": {"scene_id": 101}}}'; 

$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$token}"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);  
curl_setopt($ch, CURLOPT_POST, 1);  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$b = curl_exec($ch);
$strjson=json_decode($b);
$ticket = $strjson->ticket;//获取ticket
$ticket=urlencode($ticket);

//换取二维码
$url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$ticket}";

echo $url;


?>



