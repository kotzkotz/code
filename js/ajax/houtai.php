<?php

header('Access-Control-Allow-Origin: *'); 

// 接收参数
if(isset($_POST['param']))
	$param = $_POST['param'];
else
	$param = 0;

// 模拟数据库
$diqu = array(
	0=>array(),
	1=>array(3=>'石家庄',4=>'保定'),
	2=>array(5=>'郑州',6=>'开封',),
	3=>array('新华区','长安区','桥西区','裕华区'),
	4=>array('新市区','北市区','南市区'),
	5=>array('金水区','二七区'),
	6=>array('龙亭区','鼓楼区')
	);
// 模拟取数据
$zhenshuju = $diqu[$param];

// 返回json数据
echo json_encode($zhenshuju);

?>