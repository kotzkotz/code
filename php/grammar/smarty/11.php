<?php 

require('./Smarty/libs/Smarty.class.php');
require('./mysmarty.php');

mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use boolshop');

$sql = 'select goods_id,goods_name,shop_price,add_time from goods limit 5';
$rs = mysql_query($sql);
$goods = array();
while($row = mysql_fetch_assoc($rs)){
	$goods[] = $row;
}




$smarty = new mysmarty();
$smarty->assign('goods',$goods);
$smarty->assign('poem','tHIs IS BEIjINg,HahA');


$smarty->display('11.html');

?>