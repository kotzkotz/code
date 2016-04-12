<?php

include('./memcached-client.php');

$mc = new memcached(array(
	'servers'=>array('127.0.0.1:11211'),		//连接memcacheip和端口
	'debug'=>false,								//是否debug
	'compress_threshold'=>10240,				//最大压缩比
	'persistant'=>true 							//是否持久连接
	));

//指令细节跟.dll文件一致
$mc->add('key3',array('beijing','shijiazhuang'));			//添加
$mc->set('key2',array('beijing','shijiazhuang'));			//修改
$mc->replace('key2',array('beijing','shijiazhuang'));		//修改

$content = $mc->get('key3');
var_dump($content);
$mc->delete('key3');										//删除

?>