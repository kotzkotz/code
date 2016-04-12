<?php

$code=$_GET["code"];

$appid="wx7ced2a8593275753";//填写appid
$secret="71f475563d00103a356943875e96d43a";//填写secret
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$openid= $strjson->openid;




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
<script>
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideOptionMenu');
});
</script>
<body>
<div data-role="page" id="page3">
  <div data-role="header">
    <h1>投票</h1>
    
  </div>
      <div data-role="content">
   
 <form action="post1.php" method="get" data-ajax="false" >
   <div data-role="fieldcontain">
     <fieldset data-role="controlgroup">
       <legend>你的微信公众号是</legend>
       <input type="radio" name="radio1" id="radio1_0" value="订阅号" />
       <label for="radio1_0">订阅号</label>
       <input type="radio" name="radio1" id="radio1_1" value="服务号" />
       <label for="radio1_1">服务号</label>
     </fieldset>
   </div>
  <input name="openid" type="hidden" value="<?php echo $openid; ?>">
 
 
 
     
   
     <div class="ui-block-a">
       <button type="submit" data-role="button" >提交</button>
       </div>
    
       </div>
   </div>
 </form>  
      </div>
 </div>
 
</body>
</html>