分表技术有(水平分割和垂直分割)

水平分割：
当一张越来越大时候，即使添加索引还慢的话，我们可以使用分表
以qq用户表来具体的说明一下分表的操作.
思路如图 ：
首先我创建三张表 user0 / user1 /user2 , 然后我再创建 uuid表，该表的作用就是提供自增的id,然后用%3来选择存放在哪个表
走代码:
create table user0(
id int unsigned primary key ,
name varchar(32) not null default '',
pwd  varchar(32) not null default '')
engine=myisam charset utf8;

create table user1(
id int unsigned primary key ,
name varchar(32) not null default '',
pwd  varchar(32) not null default '')
engine=myisam charset utf8;

create table user2(
id int unsigned primary key ,
name varchar(32) not null default '',
pwd  varchar(32) not null default '')
engine=myisam charset utf8;


create table uuid(
id int unsigned primary key auto_increment)engine=myisam charset utf8;
编写addUser.php
<?php

	//注册一个用户
	$con=mysql_connect("localhost","root","root");
	if(!$con){
		die("连接失败!");
	}
	mysql_select_db("temp",$con);

	$name=$_GET['name'];
	$pwd=$_GET['pwd'];

	//这时我们先获取用户id,id是从uuid表获取

	$sql="insert into uuid values(null)";

	if(mysql_query($sql,$con)){
		
		$id=mysql_insert_id();
	}

	//计算表名，就是，你应该把这个用户放入到哪个表
	$talname='user'.$id%3;							#水平分割核心点

	$sql="insert into {$talname} values ($id,'$name','$pwd')";

	if(mysql_query($sql,$con)){
		
		echo '添加用户到 '.$talname.'ok';
	}

	mysql_close($con);
	
//
<?php

	//注册一个用户
	$con=mysql_connect("localhost","root","root");
	if(!$con){
		die("连接失败!");
	}
	mysql_select_db("temp",$con);

	$id=intval($_GET['id']);

	//计算表名
	$tabname='user'.$id%3;

	$sql="select pwd from {$tabname} where id=$id";

	$res=mysql_query($sql,$con);

	if($row=mysql_fetch_assoc($res)){
		
		echo "在{$tabname}. 中发现 id号为 {$id}";
	}


--------------------------------------------------------------------------------------------------------------


垂直分割：
一句话: 如果一张表某个字段，信息量大，但是我们很少查询，则可以考虑把这些字段，单独的放入到一张表中，这种方式称为垂直分割.