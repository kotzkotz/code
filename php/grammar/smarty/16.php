<?php 

require('./smarty/libs/smarty.class.php');

require('./mysmarty.php');

$smarty = new MySmarty();

$smarty->assign('title','呵呵');

echo $smarty->fetch('16.html');

?>