<?php
$id=$_GET["id"];
$contentStr=$_POST["textarea"];

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

//主动回复

include ("conn.php");
$sql = "SELECT * FROM `message` where `id`= '{$id}'";
$query=mysql_query($sql);
$rm=mysql_fetch_array($query);
$fromUsername=$rm['openid'];
echo $fromUsername;
$contentStr=urlencode($contentStr);

      
$a=array("content"=>"{$contentStr}");
     $b=array("touser"=>"{$fromUsername}","msgtype"=>"text","text"=>$a);
$post=json_encode($b); 
$post=urldecode($post);
$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$token}";
 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_exec($ch);    
curl_close($ch); 

      
   
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head>
<body>
<div data-role="page" id="page3">
  <div data-role="header">
    <h1>手机回复</h1>
     <a href="/message.php" data-role="button" data-icon="arrow-l">back</a> 
    </div>
    <div data-role="content">
    
回复成功
</div>
</body>
</html>