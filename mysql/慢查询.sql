#如果存储引擎是myisam,一定要定时进行碎片整理
optimize table 表名;

#定位慢查询
show status
#常用的:
show status like 'uptime' ; 	#运行时间
show stauts like 'com_select'  show stauts like 'com_insert' ...类推 update  delete		#执行次数

#show [session|global] status like .... 如果你不写  [session|global] 默认是session 会话，指取出当前窗口的执行，如果你想看所有(从mysql 启动到现在，则应该 global)

show status like 'connections';     	#显示连接数
show status like 'slow_queries';	    #显示慢查询次数
#默认情况下，mysql认为10秒才是一个慢查询.
show variables like '%query%log%';      #查看当前慢查询配置
show variables like 'long_query_time';	#可以显示当前慢查询时间

#修改my.cnf，在“[mysqld]”下面添加
slow_query_log = ON #开启慢查询日志
slow_query_log_file = /var/www/log/mysql-slow.log #日志记录位置
long_query_time = 2 #超过多长时间在记录
log-queries-not-using-indexes #记录所有没有用上索引全表扫描的语句，就算你的SQL没有超过long_query_time设置的时间。

#设置权限
chmod 777 /var/www/log

#重启mysql后测试
select sleep(3);



#构建大表->大表中记录有要求, 记录是不同才有用，否则测试效果和真实的相差大.

#创建数据库：
CREATE DATABASE temp;
#选择数据库：
USE temp;

#创建数据表
CREATE TABLE dept( /*部门表*/
deptno MEDIUMINT   UNSIGNED  NOT NULL  DEFAULT 0,  /*编号*/
dname VARCHAR(20)  NOT NULL  DEFAULT "", /*名称*/
loc VARCHAR(13) NOT NULL DEFAULT "" /*地点*/
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;


CREATE TABLE emp
(empno  MEDIUMINT UNSIGNED  NOT NULL  DEFAULT 0, /*编号*/
ename VARCHAR(20) NOT NULL DEFAULT "", /*名字*/
job VARCHAR(9) NOT NULL DEFAULT "",/*工作*/
mgr MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,/*上级编号*/
hiredate DATE NOT NULL,/*入职时间*/
sal DECIMAL(7,2)  NOT NULL,/*薪水*/
comm DECIMAL(7,2) NOT NULL,/*红利*/
deptno MEDIUMINT UNSIGNED NOT NULL DEFAULT 0 /*部门编号*/
)ENGINE=MyISAM DEFAULT CHARSET=utf8 ;


CREATE TABLE salgrade
(
grade MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
losal DECIMAL(17,2)  NOT NULL,
hisal DECIMAL(17,2)  NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

#测试数据

INSERT INTO salgrade VALUES (1,700,1200);
INSERT INTO salgrade VALUES (2,1201,1400);
INSERT INTO salgrade VALUES (3,1401,2000);
INSERT INTO salgrade VALUES (4,2001,3000);
INSERT INTO salgrade VALUES (5,3001,9999);

#为了存储过程能够正常执行，我们需要把命令执行结束符修改
delimiter $$

#创建一个函数
create function rand_string(n INT) 
returns varchar(255) #该函数会返回一个字符串
begin 
#chars_str定义一个变量 chars_str,类型是 varchar(100),默认值'abcdefghijklmnopqrstuvwxyzABCDEFJHIJKLMNOPQRSTUVWXYZ';
declare chars_str varchar(100) default
'abcdefghijklmnopqrstuvwxyzABCDEFJHIJKLMNOPQRSTUVWXYZ';
declare return_str varchar(255) default '';
declare i int default 0;
while i < n do 
set return_str =concat(return_str,substring(chars_str,floor(1+rand()*52),1));
set i = i + 1;
end while;
return return_str;
end $$

#创建一个存储过程
create procedure insert_emp(in start int(10),in max_num int(10))
begin
declare i int default 0; 
#set autocommit =0 把autocommit设置成0
set autocommit = 0;  
repeat
set i = i + 1;
insert into emp values ((start+i) ,rand_string(6),'SALESMAN',0001,curdate(),2000,400,rand_num());
until i = max_num
end repeat;
commit;
end $$


# 随机产生部门编号
drop  function rand_num $$
#这里我们又自定了一个函数
create function rand_num( )
returns int(5)
begin 
declare i int default 0;
set i = floor(10+rand()*500);
return i;
end $$

select rand_num()$$		#调用函数
#写完函数和存储过程之后还把结束符修改回分号；
delimiter ;
#调用刚刚写好的函数,1800000条记录,从100001号开始
call insert_emp(100001,4000000);	#调用存储过程