开始：START TRANSACTION或BEGIN语句可以开始一项新的事务
提交：COMMIT可以提交当前事务，是变更成为永久变更
回滚：ROLLBACK可以回滚当前事务，取消其变更


create table bank
(  
id int unsigned not null auto_increment primary key,
name char(20) not null,
money int not null
)  ENGINE=innodb charset=utf8;

insert into bank(name,money) values ('张三',5000),('李四',5000);
insert into a(name,num) values ('电脑',10),('手机',10),('冰箱',10),('洗衣机',10);

start transaction;
update bank set money=money-1000 where id=1;
update bank set money=money+1000 where id=2;
commit/ROLLBACK;