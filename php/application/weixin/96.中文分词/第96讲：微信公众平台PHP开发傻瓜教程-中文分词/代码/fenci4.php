<form action="fenci4.php" method="post">
<input name="content" type="text">
  <button type="submit" >提交</button>


</form>

<?php 
$str=$_POST["content"];
$seg = new SaeSegment();
$ret = $seg->segment($str, 1);
for ($i= 0;$i<count($ret); $i++){
$tag=$ret[$i]["word_tag"];
if($tag=="95"){	
$str=$ret[$i]["word"];	
$mysql = new SaeMysql();
$sql="SELECT * FROM `fenci` where `que` LIKE '%{$str}%'";
$data = $mysql->getData($sql);
echo $data[0][que];
echo "<br>***************<br>";
echo $data[0][ans]; 
echo "<br>***************<br>";
}
}
 
 
 
 ?>  

