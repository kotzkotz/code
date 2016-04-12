<?php

$openid=$_GET["openid"];
$radio=$_GET["radio1"];
include("conn.php");
require_once ( "BaeCounter.class.php" ) ;
//创建两个counter，对其进行操作
	$cr = new BaeCounter();
	
	$dy = $cr->register('dy');
	$fw = $cr->register('fw');
$sql="SELECT * FROM `vote` where `openid`= '{$openid}'";
				$query=mysql_query($sql);
				$rm=mysql_fetch_array($query);
				$user=$rm['openid'];
                     if (empty($user))
                     {                 
	$sql="INSERT INTO `vote` (`openid` ,`item`)VALUES (
'{$openid}', '{$radio}')";
                     mysql_query($sql);

	
	
	//对其中一个counter执行加、减、赋值操作
					if ($radio=="订阅号")
					{$dy = $cr->increase('dy',1);
					}
					else{
						$fw = $cr->increase('fw',1);
						}
		 }
	else{
		$a="你已经投过票了";
		
		}	 
	//查询指定counter
	$dy = $cr->get('dy');
	$fw = $cr->get('fw');



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