<?php

// 练习用PHPmailer发送邮件
header("Content-type:text/html;charset=utf-8");

require('./PHPMailer/class.phpmailer.php');

$phpmailer = new PHPMailer();

$phpmailer->IsSMTP();
$phpmailer->Host = '192.168.0.110';
$phpmailer->SMTPAuth = true;
$phpmailer->Username = 'kop';
$phpmailer->Password = '880511';

//发信
$phpmailer->From = 'we@qq.com';
$phpmailer->FromName = 'sky';
$phpmailer->Subject = '霸气外露5';
$phpmailer->Body = '你实在太厉害了';

//设置收件人
$phpmailer->AddAddress('304400612@qq.com','kop2');

//发信
echo $phpmailer->send()?'ok':'fail';


/*
Telnet 192.168.0.110 25 				//连接
HELO 192.168.0.110 							//先打招呼
MAIL FROM:<kop@192.168.0.110> 		//谁发的
RCPT TO:<304400612@qq.com>    		//发给谁
DATA 								//开始准备写
Subject:最后一封 					//邮件标题
From:<king@163.com> 				//收件显示的发件人
To:LOL第一人 						//邮件显示的收件人，后面接两个回车

你很好，很厉害，来加入我们吧 			//主题内容
. 									//结束
quit  								//退出


------------------------------------------------------------------------

telnet 192.168.0.110 25

HELO 192.168.0.110

AUTH LOGIN                        #登录认证

cGhwMDYyMA==          a29w            #base64加密的用户名 这里是php0620

MTIzNDVneQ==           ODgwNTEx           #base64的密码 这里是12345gy

mail from:<php0620@163.com>			mail from:<kop@192.168.0.110>

rcpt to:<304400612@qq.com>

data

Subject:最后一封 				
From:<king@163.com> 				
To:LOL第一人 						

宇宙第一ADC我们需要你
.

quit*/

?>