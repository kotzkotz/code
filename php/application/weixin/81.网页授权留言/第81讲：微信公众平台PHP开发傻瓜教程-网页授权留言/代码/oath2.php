<?php

$code=$_GET["code"];


$appid="";//填写appid
$secret="";//填写secret
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$token = $strjson->access_token;
$openid= $strjson->openid;

$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);

$strjson=json_decode($a);
$nickname = $strjson->nickname;




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
    <h1>留言板</h1>
    
  </div>
      <div data-role="content">
   
 <form action="post2.php" method="get" data-ajax="false" >
 <input name="nickname" type="hidden" value="<?php echo $nickname; ?>">
 
      <div data-role="fieldcontain">
     <label for="textarea">请<?php echo $nickname; ?>留言:</label>
     <textarea cols="40" rows="8" name="textarea" id="textarea"></textarea>
      </div>
     
   <div class="ui-grid-a">
       <div class="ui-block-a">
         <button type="submit" data-role="button" >提交</button>
       </div>
      <div class="ui-block-b"> <button type="reset" data-role="button">取消</button>
       </div>
   </div>
 </form>  
      </div>
 </div>
 
</body>
</html>