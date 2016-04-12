<?php
$id=$_GET["id"];
include ("conn.php");
$sql = "SELECT * FROM `message` where `id`= '{$id}'";
$query=mysql_query($sql);
$rm=mysql_fetch_array($query);
$liuyan=$rm['message'];

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
    <ol data-role="listview">
      <li><?php echo $liuyan;?></li>
   </ol>
   
   
 <form action="/send.php?id=<?php echo $id;?>" method="post" >
   <div data-role="fieldcontain">
     <label for="textarea">回复:</label>
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
</div>
</body>
</html>

