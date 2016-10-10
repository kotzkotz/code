<?php

header("Content-type: text/html; charset=utf-8");

$serverinfo = @ini_get('safe_mode')?'true':'false';

$rs = mysql_connect('localhost','root','root');
if(function_exists('mysql_get_server_info')){
	$dbversion = mysql_get_server_info();
}else{
	$rs = mysql_query('SELECT VERSION()');
	$row = mysql_fetch_row($rs);
	$dbversion = $row[0];
}
mysql_close($rs);

?>

<ul>
	<li><span>服务器:</span><?php echo $_SERVER['SERVER_SOFTWARE'];?></li>
	<li><span>操作系统:</span><?php echo PHP_OS;?></li>
	<li><span>PHP版本:</span><?php echo PHP_VERSION;?></li>
	<li><span>safe_mode:</span><?php echo $serverinfo;?></li>
	<li><span>MySQL版本:</span><?php echo $dbversion;?></li>
</ul>