<?php 

include('./Smarty/Libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->template_dir = './temp';
$smarty->compile_dir = './comp';
$smarty->config_dir = './conf';

$smarty->assign('id',$_GET['id']);

define('HEI','180');

$smarty->display('05temp.html');

?>