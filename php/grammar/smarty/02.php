<?php 

include('./Smarty/Libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->template_dir = './templates';
$smarty->compile_dir = './compile';


$title = '开会';
$content = '这是一个好会';

$smarty->assign('title',$title);
$smarty->assign('content',$content);

$smarty->display('./templates/02temp.html');




?>