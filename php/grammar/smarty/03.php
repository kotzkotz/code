<?php 

include('./Smarty/Libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->template_dir = './templates';
$smarty->compile_dir = './compile';

$zs = array('name'=>'张三','age'=>'15','sex'=>'男');
$smarty->assign('zs',$zs);

$ls = array('name'=>'李四','age'=>'17','sex'=>'女');
$smarty->assign('ls',$ls);

$ww = array('name'=>'王五','age'=>'19','sex'=>'男');
$smarty->assign('ww',$ww);

$smarty->display('03temp.html');

?>