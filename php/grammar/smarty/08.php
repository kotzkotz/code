<?php 

require('./smarty/libs/Smarty.class.php');
require('./mysmarty.php');

$smarty = new mysmarty();


$smarty->assign('price',1000);
$arr = array('name'=>'张三','height'=>180,'house'=>'180','age'=>18);
$smarty->assign($arr);



$smarty->display('08.html');

?>