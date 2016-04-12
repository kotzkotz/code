<?php
include ("conn.php");
$sql = "SELECT * FROM `message` ORDER BY `id` DESC limit 9 ";
$query=mysql_query($sql);
while($rm=mysql_fetch_array($query))
{
	$liuyan[]=$rm['message'];
	$num[]=$rm["id"];
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
    <a href="#" data-role="button" data-icon="arrow-l" data-rel="back">back</a> 
  </div>
  <div data-role="content">
    <ul data-role="listview">
      <li><a href="/post.php?id=<?php echo $num[0]; ?>"><?php echo $liuyan[0];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
      <li><a href="/post.php?id=<?php echo $num[1]; ?>"><?php echo $liuyan[1];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
      <li><a href="/post.php?id=<?php echo $num[2]; ?>"><?php echo $liuyan[2];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
      <li><a href="/post.php?id=<?php echo $num[3]; ?>"><?php echo $liuyan[3];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
      <li><a href="/post.php?id=<?php echo $num[4]; ?>"><?php echo $liuyan[4];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
      <li><a href="/post.php?id=<?php echo $num[5]; ?>"><?php echo $liuyan[5];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
      <li><a href="/post.php?id=<?php echo $num[6]; ?>"><?php echo $liuyan[6];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
      <li><a href="/post.php?id=<?php echo $num[7]; ?>"><?php echo $liuyan[7];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
      <li><a href="/post.php?id=<?php echo $num[8]; ?>"><?php echo $liuyan[8];?>
        <p class="ui-li-aside">回复</p>
      </a></li>
    </ul>
    </div>
   
    
    
    
    
    
    
    
   
   
 
  </div>

  
  </div>
</div>
</body>
</html>

