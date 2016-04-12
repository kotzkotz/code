<form action="fenci.php" method="post">
<input name="content" type="text">
  <button type="submit" >提交</button>


</form>

<?php 
$str=$_POST["content"];
 
 $seg = new SaeSegment();
 $ret = $seg->segment($str, 1);
 
 print_r($ret);    //输出
 
 
 ?>  

