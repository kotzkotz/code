<?php

header("Content-type:text/html;charset=utf-8");

$mem=new Memcache();

//连接memcached
if(!$mem->connect('192.168.0.110',11211)){
	exit('连接失败！');
}

//添加（只能添加一次，如果存在就返回false）MEMCACHE_COMPRESSED表示压缩
if($mem->add('key1','beijing',MEMCACHE_COMPRESSED,60)){
	echo 'add添加成功！','<br />';
}else{
	echo 'add添加失败！','<br />';
}

//修改
//set如果存在就修改，不存在就创建
if($mem->set('key2','shijiazhuang',MEMCACHE_COMPRESSED,time()+31*3600*24)){		//超过30天的添加方法
	echo 'set修改成功！','<br />';
}else{
	echo 'set修改失败！','<br />';
}
//replace如果存在就修改，如果不存在就返回false
if($mem->replace('key1','田家庄',MEMCACHE_COMPRESSED,60)){
	echo 'replace修改成功！','<br />';
}else{
	echo 'replace修改失败！','<br />';
}


//查看
$val=$mem->get('key1');
var_dump($val);

//delete如果加上第二个参数，表示多长时间后删除，没有就立即删除
if($mem->delete('key2',10)){
	echo 'delete删除成功！','<br />';
}else{
	echo 'delete删除失败！','<br />';
}

?>