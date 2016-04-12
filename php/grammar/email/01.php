<?php

/*
telnet 发邮件

1:查询邮件服务器的MX记录  nslookup -q=mx 163.com

163:
163mx02.mxmail.netease.com
163mx01.mxmail.netease.com
163mx00.mxmail.netease.com
163mx03.mxmail.netease.com

qq:
mx1.qq.com
mx2.qq.com
mx3.qq.com

sina:
Non-authoritative answer:
freemx1.sinamail.sina.com.cn
freemx2.sinamail.sina.com.cn
freemx3.sinamail.sina.com.cn

2: 把该地址写到php.ini里去
SMTP =  163mx02.mxmail.netease.com
sendmail_from = wusong@192.168.1.100 
*/

var_dump(mail('304400612@qq.com','你很好','这个是来自自动发送的，请不要回复'));



/*

Telnet mx1.qq.com 25 				//连接
HELO qq 							//先打招呼
MAIL FROM:<sjzzhucong@163.com> 		//谁发的
RCPT TO:<304400612@qq.com>    		//发给谁
DATA 								//开始准备写
Subject:最后一封 					//邮件标题
From:<king@163.com> 				//收件显示的发件人
To:LOL第一人 						//邮件显示的收件人，后面接两个回车

你很好，很厉害，来加入我们吧 			//主题内容
. 									//结束
quit  								//退出

*/


/*

telnet smtp.163.com 25

EHLO 163.com

AUTH LOGIN                        #登录认证

cGhwMDYyMA==                      #base64加密的用户名 这里是php0620

MTIzNDVneQ==                      #base64的密码 这里是12345gy

mail from:<php0620@163.com>

rcpt to:<714119062@qq.com>

data

Subject:最后一封 				
From:<king@163.com> 				
To:LOL第一人 						

宇宙第一ADC我们需要你
.

quit

*/

?>