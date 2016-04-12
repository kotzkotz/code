<?php
$mysql = new SaeMysql();//sae内部类链接数据
$sql = "SELECT * FROM `user3` ORDER BY `id` DESC limit 6 ";
$data = $mysql->getData($sql);
echo json_encode($data);
?>


    

