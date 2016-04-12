<?php 

require('./smarty/libs/Smarty.class.php');
require('./mysmarty.php');


mysql_connect('localhost','root','root');
$sql = 'set names utf8';
mysql_query($sql);
$sql = 'use boolshop';
mysql_query($sql);
$sql = 'select goods_id,goods_name,shop_price from goods limit 5';
$rs = mysql_query($sql);
$goods = array();
while($row = mysql_fetch_assoc($rs)){
	$goods[] = $row;
}



$smarty = new mysmarty();
$smarty->assign('goods',$goods);
$smarty->assign('age',10);

$smarty->display('10.html');

?>