<?php

require('./PHPMailer/class.phpmailer.php');

$phpmailer = new PHPMailer();


//配置
$phpmailer->IsSMTP();
$phpmailer->Host = 'smtp.163.com';
$phpmailer->SMTPAuth = true;
$phpmailer->Username = 'php0620';
$phpmailer->Password = '12345gy';

//发信
$phpmailer->From = 'php0620@163.com';
$phpmailer->FromName = 'php0620';
$phpmailer->Subject = '我来自山东';
$phpmailer->Body = '欢迎你过来玩';

//设置收件人
$phpmailer->AddAddress('php0620@163.com','php0620');
// 添加一个抄送
$phpmailer->ADDCC('304400612@qq.com','你好');

//发信
echo $phpmailer->send()?'ok':'fail';

?>