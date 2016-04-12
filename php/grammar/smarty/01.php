<?php 

include('./mini.php');

$mini = new mini();

$mini->template_dir = './templates';
$mini->compile_dir = './compile';

$mini->assign('title','米氏家居');
$mini->assign('content','效果非常好');

$mini->display('01temp.html');

?>