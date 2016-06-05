<?php

mysql_connect('localhost','root','root');
$sql = 'set names utf8';
mysql_query($sql);
mysql_select_db('thinkcmf2');
$rs = mysql_query('show tables');
$arr = array();
/*

如果您想要把表默认的字符集和所有字符列（CHAR, VARCHAR, TEXT）改为新的字符集，应使用如下语句：
ALTER TABLE tbl_name CONVERT TO CHARACTER SET 。。。
要仅仅改变一个表的默认字符集，应使用此语句：
ALTER TABLE tbl_name DEFAULT CHARACTER SET 。。。

*/
while ($row = mysql_fetch_array($rs)){
	$sql = "ALTER TABLE  `$row[0]` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci";
	$a = mysql_query($sql);
	var_dump($a);
}


echo 'ok';



?>