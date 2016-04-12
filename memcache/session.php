<?php

/*
修改php.ini的配置文件
如下:
;[sesson.save_handler 有user|files|memcache]
session.save_handler = memcache
session.save_path = "tcp://127.0.0.1:11211"
*/

//传统的代码
session_start();
$_SESSION['name']='天龙八部300';
$_SESSION['city']='beijing';
class Dog{
	public $name;
}

$dog1=new Dog;
$dog1->name='abcde';
$_SESSION['dog']=$dog1;

//如果session数据入mem，那他一定是以session_id为
//key值进行添加

//取出
$name=$_SESSION['name'];
echo "name=$name";
echo "sessionid=".session_id();

/*
如果管理不让修改php.ini则可以使用ini_set函数
ini_set("session.save_handler","memcache");
ini_set("session.save_path","tcp://127.0.0.1:9999");

例：
ini_set("session.save_handler","memcache");
ini_set("session.save_path","tcp://127.0.0.1:9999");
//传统的代码
session_start();
$_SESSION['name']='4000';
$_SESSION['city']='beijing';
class Dog{
	public $name;
}

$dog1=new Dog;
$dog1->name='abcde';
$_SESSION['dog']=$dog1;

//如果session数据入mem，那他一定是以session_id为
//key值进行添加

//取出
$name=$_SESSION['name'];
echo "name=$name";
echo "sessionidu=".session_id();
*/

?>