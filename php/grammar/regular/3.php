<?php

header("Content-type:text/html;charset=utf-8");

//修饰符

//修饰符放在//的外面

//i表示不区分大小写

//m表示匹配首尾的时候，如果遇到换行，也应该承认是结尾

//x表示忽略掉规则模式中的空白字符

//A表示必须从头开始匹配

$mode = '/php/i';   //规则模式
$string = 'PHP';   //字符串

if (preg_match($mode,$string)) {
	echo '匹配';
} else {
	echo '不匹配';
}

?>