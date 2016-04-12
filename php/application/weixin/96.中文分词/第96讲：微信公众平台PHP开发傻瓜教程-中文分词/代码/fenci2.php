<form action="fenci2.php" method="post">
<input name="content" type="text">
  <button type="submit" >提交</button>


</form>

<?php 
$str=$_POST["content"];

$mysql = new SaeMysql();
$sql="SELECT * FROM `fenci` where `que` LIKE '%{$str}%'";
$data = $mysql->getData($sql);
echo $data[0][que];
echo "<br>***************<br>";
echo $data[0][ans]; 
 
 
 
 
 ?>  

