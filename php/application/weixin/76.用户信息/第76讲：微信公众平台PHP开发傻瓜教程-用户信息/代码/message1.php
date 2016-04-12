<?php
include ("conn.php");
$sql = "SELECT * FROM `message` ORDER BY `id` DESC limit 9 ";
$query=mysql_query($sql);
while($rm=mysql_fetch_array($query))
{
	$liuyan[]=$rm['message'];
	$openid[]=$rm["openid"];
}

for ($i= 0;$i<count($openid); $i++){
	$sql = "SELECT * FROM  `user` WHERE  `openid` ='{$openid[$i]}'";
	
$query=mysql_query($sql);
$rm=mysql_fetch_array($query);
$image[$i]=$rm["image"];
$nickname[$i]=$rm["nickname"];
	}

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
  
    <ul data-role="listview" data-inset="true">
      <?php 
	  for ($i= 0;$i<10; $i++){
	  ?>
      <li>
      <img src="<?php echo $image[$i];?>">
      <h4><?php echo $nickname[$i];?></h4>
      <p><?php echo $liuyan[$i];?></p>
      </li>
     <?php } ?> 
    </ul>
    </div>
   
    
    
    
    
    
    
    
   
   
 
  </div>

  
  </div>
</div>
</body>
</html>

