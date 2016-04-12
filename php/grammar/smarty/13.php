<?php 

$id = $_GET['id'] + 0;

require('./Smarty/libs/Smarty.class.php');
require('./mysmarty.php');

$smarty = new mysmarty();

if($smarty->clearCache('12.html',$id)){
	echo '删除',$id,'号产品成功';
}else{
	echo $id,'号产品不存在';
}








?>