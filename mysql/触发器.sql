CREATE TABLE  `a` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `name` VARCHAR( 200 ) NOT NULL ,
 `num` INT NOT NULL
) ENGINE = MYISAM charset=utf8;

CREATE TABLE  `b` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `aid` INT NOT NULL ,
 `much` INT NOT NULL
) ENGINE = MYISAM charset=utf8;

insert into a(name,num) values ('电脑',10),('手机',10),('冰箱',10),('洗衣机',10);



#监控insert
delimiter |
create trigger f1 
before insert on b
for each row 
begin
update a set num=num-new.much where id=new.aid;
end|
delimiter ;

insert into b(aid,much) values ('1',3);



#监控delete
delimiter |
create trigger f2
after delete on b
for each row
begin
update a set num=num+old.much where id=old.aid;
end|
delimiter ;

delete from b where aid=1;



#监控update
delimiter |
create trigger f3
before update on b
for each row
begin
update a set num=num+old.much-new.much where id=old.aid;
end|
delimiter ;

update b set much=5 where aid=1;



#查看触发器
SHOW TRIGGERS [FROM schema_name];

#删除触发器
DROP TRIGGER trigger_name;