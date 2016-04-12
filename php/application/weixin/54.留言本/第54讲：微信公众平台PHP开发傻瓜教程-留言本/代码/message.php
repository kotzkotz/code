<?php
include ("coon.php");
$sql = "SELECT * FROM `message` ORDER BY `id` DESC limit 3 ";
$query=mysql_query($sql);
while($rm=mysql_fetch_array($query))
{
	$liuyan[]=$rm['liuyan'];
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
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
      <li><?php echo $liuyan[0];?></li>
      <li><?php echo $liuyan[1];?></li>
      <li><?php echo $liuyan[2];?></li>
    </ol>
   
   
 <form action="/post.php" method="post" >
   <div data-role="fieldcontain">
     <label for="textarea">留言:</label>
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

  <div data-role="footer">
    <div data-role="navbar">
      <ul>
      <li><a href="/book.html"> 首页</a></li>
     <li><a href="/mulu.html">目录</a></li>
      <li><a href="/message.php">留言</a></li>
    </ul>
   </div>
  </div>
</div>
</body>
</html>

