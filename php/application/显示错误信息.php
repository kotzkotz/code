<?php

/*
显示错误信息
注：
php碰到致命错误后就不会执行，所以如果查看当前页面致命错误时，需要把显示错误信息的配置放到上级文件，如：

显示错误信息;
include '错误文件';
*/
ini_set('display_errors','On');
ini_set('error_reporting',E_ALL);
error_reporting(E_ALL);

// 查看php配置
phpinfo();

?>