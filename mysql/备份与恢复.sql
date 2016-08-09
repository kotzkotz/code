Mysqldump可以导出
库
表

导出:cmd控制台
例1: 导出mugua库下面的表

如果报：-- Warning: Skipping the data of table mysql.event. Specify the --events option explicitly.
则需要加上：--events --ignore-table=mysql.events
因为mysqldump默认是不备份事件表的，加了--events 才会备份

Mysqldump --events --ignore-table=mysql.events -u用户名 -p密码 库名 表1 表2 表3 > 地址/备份文件名称
导出的是建表语句及insert语句

例2:如何导出一个库下面的所有表?
Mysqldump -u用户名 -p密码 库名 > 地址/备份文件名称

例3: 如何导出以库为单位导出?
Mysqldump -u用户名 -p密码 -B 库1 库2 库3 > 地址/备份文件名称

例4: 如何导出所有库?
Mysqldump -u用户名 -p密码 -A > 地址/备份文件名称

恢复:mysql控制台
1:登陆到mysql命令行
对于库级的备份文件
Mysql> source 备份文件地址

对于表级的备份文件
Mysql > use 库名
Mysql> source 备份文件地址

2:不登陆到mysql命令行
针对库级的备份文件
Mysql  -u用户名 -p密码 < 库级备份文件地址

针对表级的备份文件
Mysql  -u用户名 -p密码 库名 < 表级备份文件地址

使用定时器来完成
原理：
1，新建文件，必须以“.bat”结尾，如：'mysqlboolshop.bat'；
内容：
"C:\AppServ\MySQL\bin\mysqldump" -uroot -proot boolshop > d:\boolshop.bak
注：如果地址名有空格的话必须用引号引起来
2，控制面板-》任务计划-》添加任务计划

改进：
'mysqlboolshop.bat'的内容改成执行一个PHP文件：
linux: /usr/local/php/bin/php /test.php
windows: C:\AppServ\php5\php.exe C:\AppServ\www\dsbf.php
'dsbf.php'的内容是：
<?php
	//定时备份我们的数据库文件
	
	date_default_timezone_set('PRC');

	$bakfilename=date("YmdHis",time());

	$command="C:\AppServ\MySQL\bin\mysqldump -uroot -proot boolshop > d:\mysqlbf\\$bakfilename";

	exec($command);
?>


-----------------------------------------------------------------------------------------------------------------


增量备份（不用定时器，是执行一句就备份一句）：
配置 my.ini文件 或者 my.conf 启用二进制备份

找到[mysqld]
log-bin=e:/mysqldb/logbin.log    先设置mysql日志存放位置

binlog_format       = MIXED                 //binlog日志格式
expire_logs_days    = 7                //binlog过期清理时间
#max_binlog_size    100m                    //binlog每个日志文件大小 最大值和默认是１个Ｇ
binlog-do-db=game     #需要备份的数据库名，如果备份多个数据库，重复设置这个选项即可
binlog-do-db=platform #
#binlog-ignore-db=不需要备份的数据库，如果备份多个数据库，重复设置这个选项即可


配置好后 再启动模样上去了 就会在备份目录多了2个文件 
logbin.index  这个是索引文件 有哪些增量备份
logbin.000001   存放用户对数据库操作的文件

如果你想看看 这个 里面是什么东西 我们可以使用 mysql的bin目录下面的一个工具查看 
就是 mysqlbinlog.exe  这个东西看 

首先用cmd进入 mysql的 bin目录下面 然后执行
mysqlbinlog e:/mysqldb/logbin.000001

mysql 对于你的每一次操作 都会记录一次时间 同时 给你分配一个位置 （pos）
换句话说 以后我们恢复 可以根据时间点来恢复 或者根据位置来恢复

时间点恢复
我们可以画个流程图
logbin.000001
insert ......   3       2013-07-23 17:57:00
update .....   4    2013-07-23 17:59:00
insert ......   100       2013-07-23 19:57:00
drop  ...        101    2013-07-23 20:57:00

恢复的话可以这么写
mysqlbinlog  --stop-datatime="2013-07-23 20:50:00" e:/mysqldb/logbin.000001
上面这句的意思是 一直恢复到 2013-07-23 20:50:00  停止
mysqlbinlog  --start-datatime="2013-07-23 20:50:00" e:/mysqldb/logbin.000001
上面这句的意思是 从2013-07-23 20:50:00  开始恢复

按照位置来恢复
mysqlbinlog  --stop-position="100" e:/mysqldb/logbin.000001  | 
上面这个语句意思是 恢复到100的位置

真实性恢复
按照位置恢复
mysqlbinlog  --stop-position=4590 e:/mysqldb/logbin.000001  | mysql -uroot -p
按照时间恢复
mysqlbinlog  --stop-datetime="2013-07-24 18:17:19" e:/mysqldb/logbin.000001  | mysql -uroot -p
 
可以控制从什么时候开始 到什么是结束
（1）指定点恢复：
mysqlbinlog  --start-position=918 --stop-position=2448 mysqld-bin.000007 | mysql -uroot -p
其中--stop-position和--start-position的值为文件中的end_log_pos
（2）指定时间点恢复
mysqlbinlog --start-date="2009-06-24 13:11:01" --stop-date="2009-06-24 14:27:31"  mysqld-bin.000007 | mysql -uroot -p


主要可以通过时间和位置两种方式恢复：
mysqlbinlog --stop-datetime="2013-01-14 18:20:21" d:/log/mylog.000001 | mysql -uroot -p911004
从开始到这个时间点
mysqlbinlog --start-datetime="2013-01-14 18:20:21" d:/log/mylog.000001 | mysql -uroot -p911004
从这个时间点到最后
mysqlbinlog --start-datetime="2013-01-14 18:20:21" --stop-datetime="2013-01-14 18:20:21" d:/log/mylog.000001 | mysql -uroot -p911004
恢复这一个时间段的数据。
mysqlbinlog --stop-position=159 d:/log/mylog.000001 | mysql -uroot -p911004
从开始到这个地方
mysqlbinlog --start-position="2013-01-14 18:20:21" d:/log/mylog.000001 | mysql -uroot -p911004
从这个地方到最后
mysqlbinlog --start-position="2013-01-14 18:20:21" --stop-position="2013-01-14 18:20:21" d:/log/mylog.000001 | mysql -uroot -p911004


如何关闭 mysql 自动记录日志
找到log-bin=mysql-bin，前面添加#即可。
个别版本需要关闭
binlog_format=mixed前面添加#，否则会出现mysql无法启动。