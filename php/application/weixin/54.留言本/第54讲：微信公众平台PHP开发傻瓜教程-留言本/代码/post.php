<?php
include ("coon.php");
$strpost=$_POST["textarea"];
$sql="INSERT INTO `message` (`id` ,`liuyan` )VALUES (
NULL , '{$strpost}')";
mysql_query($sql);
echo "留言成功";
header("Location: message.php"); 
?>
