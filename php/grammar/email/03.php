<?php

/*
模拟注册

create table user (
uid int primary key auto_increment,
uname char(20) not null default '',
email char(30) not null default '',
pass char(32) not null default '',
status tinyint not null default 0
)engine myisam charset utf8;


create table activecode (
cid int primary key auto_increment,
uname char(20) not null default '',
code char(16) not null default '',
expire int not null default 0
)engine myisam charset utf8;

*/

require('./conn.php');
require('./PHPMailer/class.phpmailer.php');

$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456!@#$%';

$uname = substr(str_shuffle($str),0,8);		//随机用户名
$email = '304400612@qq.com';

$sql = "insert into user(uname,email) value ('$uname','$email')";
mysql_query($sql,$conn);

$code = substr(str_shuffle($str),0,8);		//随机注册码
$expire = time() + 5*24*3600;

$sql = "insert into activecode(uname,code,expire) value ('$uname','$code','$expire')";
mysql_query($sql,$conn);

//发送邮件
$phpmailer = new PHPMailer();
$phpmailer->IsSMTP();
$phpmailer->Host = 'smtp.163.com';
$phpmailer->SMTPAuth = true;
$phpmailer->Username = 'php0620';
$phpmailer->Password = '12345gy';

$phpmailer->From = 'php0620@163.com';
$phpmailer->FromName = 'qq.com';
$phpmailer->Subject = $uname.'欢迎你注册';
$phpmailer->Body = '激活请点击http://localhost:8080/email/04.php?code='.$code.' 进行激活,有效期5天。';

$phpmailer->AddAddress('304400612@qq.com','邮件激活');

echo $phpmailer->send()?'ok':'fail';

?>