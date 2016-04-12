<?php 

require('./Smarty/libs/Smarty.class.php');
require('./mysmarty.php');

$smarty = new mysmarty();

//开启缓存
$smarty->caching = true;

//设置生命周期
$smarty->cache_lifetime = 3600;

//设置缓存目录，用于缓存文件
$smarty->cache_dir = './cache';

$smarty->force_cache = true; 

$id = $_GET['id'] + 0;


if(!$smarty->isCached('12.html',$id)){
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use boolshop');

$sql = 'select goods_id,goods_name,shop_price,add_time from goods where goods_id='.$id;
$rs = mysql_query($sql);
$goods = array();
while($row = mysql_fetch_assoc($rs)){
	$goods[] = $row;
}


$smarty->assign('goods',$goods);

echo '从数据库中取数据<br />';
}




$time = time();
$smarty->assign('time',$time);
$smarty->assign('time1',$time,true);
$smarty->assign('time2',$time);
$smarty->assign('time3',$time);

function insert_welcome($parm,$smarty) {
    return '你好' . $parm['user'] . rand(10000,99999);
}

function insert_say($parm,$smarty){
	return 'hello '.$parm['parm'].$parm['parm2'].rand(10000,99999);
}

$smarty->display('12.html',$id);

?>