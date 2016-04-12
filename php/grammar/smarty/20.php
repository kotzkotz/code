<?php 

/*
天气预报接口 http://flash.weather.com.cn/wmaps/xml/china.xml
*/

$cont = file_get_contents('http://flash.weather.com.cn/wmaps/xml/china.xml');

//var_dump($cont);

/*

$sjz = substr($cont,strpos($cont,'石家庄'),stripos($cont,'郑州')-strpos($cont,'石家庄'));

$stateDetailed = substr($sjz,strpos($cont,'stateDetailed="'),strpos($cont,'" tem1="')-strpos($cont,'stateDetailed="'));

echo $stateDetailed;

*/

$start = strpos($cont,'石家庄');
$end = strpos($cont,'郑州');


$noad = substr($cont,$start,$end-$start);













?>