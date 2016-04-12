<?php

set_time_limit(0);

ob_start();

$pad = str_repeat(' ',4000);

echo $pad,'<br />';

ob_flush();
flush();

$i=1;
while($i++){
	echo $i,'<br />';
	ob_flush();
	flush();
	sleep(1);
}



/*
set_time_limit(0);
ob_start();
$pad = str_repeat(' ',4000);
echo $pad,'<br />';
ob_flush();
flush();  // 把产生的内容 立即送给浏览器而不要等脚本结束再一起送.


$conn = mysql_connect('localhost','root','111111');
mysql_query('use test');

while(1) {
    $sql = 'select * from msg where flag = 0';
    $rs = mysql_query($sql,$conn);
    $row = mysql_fetch_assoc($rs);

    if(!empty($row)) {
        echo $pad,'<br />';
        echo $row['content'],'<br />';
        mysql_query('update msg set flag=1');
    }


    ob_flush();
    flush();  // 把产生的内容 立即送给浏览器而不要等脚本结束再一起送.
    sleep(1);
}
*/

?>