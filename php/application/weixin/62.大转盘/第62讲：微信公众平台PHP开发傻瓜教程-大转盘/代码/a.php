<?php
include "conn.php";
$uid=$_GET["uid"];
$prize=$_GET["btn"];
$score=$_GET["score"];
$sql="UPDATE `menu` SET `prize`={$prize},`score`={$score} where `user`= '{$uid}'";
mysql_query($sql);
header("Location: ka.php?uid=$uid"); 
?>