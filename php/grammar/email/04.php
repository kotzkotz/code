<?php

/*
模拟激活
*/

require('./conn.php');

$code = $_GET['code'];

//判断

if(strlen($code) != 8) {
    exit('激活码错误');
}

$sql = "select status from user left join activecode on user.uname = activecode.uname where activecode.code='$code'";
$rs = mysql_query($sql);
$row = mysql_fetch_assoc($rs);
if($row['status'] == 1){
	exit('你已经激活，请不要重复激活');
}

$sql = "select * from activecode where code='$code'";
$rs = mysql_query($sql,$conn);
$row = mysql_fetch_assoc($rs);

if(empty($row)){
	exit('激活码错误');
}

if(time() > $row['expire']){
	exit('激活码已过期，请重新申请！');
}

//激活
$sql = "update user set status=1 where uname='$row[uname]'";
echo mysql_query($sql)?'ok':'fail';

?>