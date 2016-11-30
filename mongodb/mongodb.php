<?php

$config = array();
$config['username'] = 'zckop';
$config['password'] = '123456';
$config['hostname'] = 'localhost';
$config['hostport'] = '27017';
$config['database'] = 'xinxiangmu';
$host = 'mongodb://'.($config['username']?"{$config['username']}":'').($config['password']?":{$config['password']}@":'').$config['hostname'].($config['hostport']?":{$config['hostport']}":'').'/'.($config['database']?"{$config['database']}":'');
// mongodb://zckop:123456@localhost:27017/xinxiangmu
echo $host,'<br />';
var_dump(new \mongoClient( $host));

?>