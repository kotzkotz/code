存储过程: procedure
概念类似于函数,就是把一段代码封装起来,
当要执行这一段代码的时候,可以通过调用该存储过程来实现.
在封装的语句体里面,可以用if/else, case,while等控制结构.
可以进行sql编程.

查看现有的存储过程:
Show procedure status

删除存储过程
Drop procedure 存储过程的名字

调用存储过程
Call 存储过程名字();


第1个存储过程 ,体会"封装sql"
create procedure p1()
begin
select * from g;
end|

第2个存储过程, 体会"参数"
create procedure p2(n int)
begin
select * from g where num > n;
end| 

第3个存储过程,体会"控制结构"
create procedure p3(n int,j char(1))
begin
if j='h' then
select * from g where num>n;
else
select * from g where num<n;
end if;
end|

第4个存储过程,体会"循环"
create procedure p4(n smallint)
begin
declare i int;
declare s int;
set i=1;
set s=0;
while i <= n do
set s = s+i;
set i = i+1;
end while;
select s;
end|

在mysql中,存储过程和函数的区别,
一个是名称不同,
二个就是存储过程没有返回值.