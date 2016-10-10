<?php

/*
运行时间：microtime(true)
所占内存：memory_get_usage()
内存使用峰值：memory_get_peak_usage()
*/

$a = microtime(true);
echo "初始: ".memory_get_usage()." 字节（byte）<br />";
for ($i = 0; $i < 100000; $i++) {
 $array []= md5($i);
}
$tmp = str_repeat('http://www.nowamagic.net/', 4000);
echo "高峰: ".memory_get_usage()." 字节（byte）<br />";
for ($i = 0; $i < 100000; $i++) {
 unset($array[$i]);
}
unset($tmp);
echo "最终: ".memory_get_usage()." 字节（byte）<br />";
echo "内存峰值: ".memory_get_peak_usage()." 字节（byte）<br />";
$b = microtime(true);
echo "运行时间：".($b-$a)."秒";

?>