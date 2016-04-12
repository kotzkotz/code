<?php
$mysql = new SaeMysql();//sae内部类链接数据
$num = "SELECT * FROM `message` ";
$mysql->runSql($num); 
$no=$mysql->affectedRows();//获取行数
echo $no;
?>


    

