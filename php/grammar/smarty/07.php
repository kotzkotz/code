<?php 

require('./Smarty/libs/Smarty.class.php');

require('./mysmarty.php');

$smarty = new mysmarty();

$smarty->assign('age',100);
$smarty->assign('wift',7);





$smarty->display('07temp.html');

?>