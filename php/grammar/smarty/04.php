<?php 

include('./Smarty/Libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->template_dir = './templates';
$smarty->compile_dir = './compile';
$smarty->left_delimiter = '{<';
$smarty->right_delimiter = '>}';

$smarty->assign('zs','张三');
$smarty->assign('age','25');
$smarty->assign('sex','男');

$smarty->display('04temp.html');

?>