<?php

$openid=$_GET["openid"];
$radio=$_GET["radio1"];
	  
$mysql = new SaeMysql();
$sql="SELECT * FROM `vote` where `openid`= '{$openid}'";
$data = $mysql->getData($sql);
$user=$data[0][openid];
$c = new SaeCounter();
 if (empty($user))
                     {                 
	$sql="INSERT INTO `vote` (`openid` ,`item`)VALUES (
'{$openid}', '{$radio}')";
        
$mysql->runSql($sql);

	
 if ($radio=="订阅号")
               {  $c->incr('dingyue',1);}//订阅号加1
		
else{	 $c->incr('fuwu',1);}//服务号加1
												
					
		 }
else{
		$a="你已经投过票了";
		
		}	 
	//查询counter
	$dy = $c->get('dingyue');
	$fw = $c->get('fuwu');



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>投票系统</title>
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
WeixinJSBridge.call('hideToolbar');
});
</script>
<body>
<div data-role="page" id="page3">
  <div data-role="header">
    <h1>投票</h1>
    
  </div>
      <div data-role="content">
        <ul data-role="listview">
          <li>订阅号<span class="ui-li-count"><?php echo $dy;?></span></li>
          <li>服务号<span class="ui-li-count"><?php echo $fw;?></span></li>
        <li><?php echo $a;?> </li>
        </ul>
        
   
 
      </div>
 </div>
 
</body>
</html>