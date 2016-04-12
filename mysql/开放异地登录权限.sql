#增加一个可远程登录的账号
insert into user(Host,User,Password) values("%","zckop",password("123456"));
#给账号分配权限
GRANT ALL PRIVILEGES ON *.* to 'zckop'@'%' IDENTIFIED BY '123456' WITH GRANT OPTION;
#刷新权限
flush privileges;