<?php 

require('./Smarty/libs/Smarty.class.php');
require('./mysmarty.php');

$smarty = new mysmarty();

$smarty->assign('title','今天天气很好');

$smarty->display('14.html');

?>