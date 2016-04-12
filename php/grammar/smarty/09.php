<?php 

require('./smarty/libs/Smarty.class.php');
require('./mysmarty.php');

$smarty = new mysmarty();

$smarty->assign('start',1);
$smarty->assign('end',10);


$smarty->display('09.html');

?>