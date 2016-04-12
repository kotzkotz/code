<?php

header("Content-type:text/html;charset=utf-8");

	$language = array('php','asp','jsp','python','ruby');
	// $mode = '/p$/';		//Array ( [0] => php [1] => asp [2] => jsp )
	$mode = '/^p/';		//Array ( [0] => php [3] => python )

	print_r(preg_grep($mode,$language));	//搜索数组中的相匹配的字符串


echo '<hr />';


	echo preg_match('/php[1-6]/','php5');	//搜索模式，最后返回的是真或者假， 1，0


echo '<hr />';

	// 邮箱验证
	$mode = '/^([\w_][\w_\.]{1,254})@([\w]{1,10}).([a-z]{2,4})$/';	//\w代表[a-zA-Z0-9_]
	$string = '304400612@qq.com';

	if(preg_match($mode,$string)){
		echo '邮件格式正确';
	}else{
		echo '邮件格式错误';
	}


echo '<hr />';


	echo '<pre>';
	preg_match_all('/php[0-6]/','php7php5asdfasdphp4fasdphp2f',$arr);
	print_r($arr);
	echo '</pre>';


echo '<hr />';


	echo preg_quote('.\+*?[^]$(){}=!<>|:'); //转义正则表达式字符,正则表达式特殊字符有：.\+*?[^]$(){}=!<>|:


echo '<hr />';


	//搜索匹配的结果，然后替换掉
	//第一个参数，放的是正则的模式
	//第二个参数，放的是替换掉的字符串
	//第三个参数，字符串
	//将第三个参数的字符串中的php5,php4替换成了python
	echo preg_replace('/php[1-6]/','python','This is a php5,This is a php4');


echo '<hr />';


	//贪婪和分组获取的案例,ubb
	//我要将这个[b][/b]换成<strong>php5</strong>	
	//注意一个问题，这个时候的[]中括号，是字符中的括号，而不是语法[a-z]	
	//.表示匹配任意字符一个，加上一个*号表示匹配零个或者多个	
	//用括号分为三组那么第一组就是\1,第二组就是\2，第三租就是\3	
	//目前只有1租，\1	
	//为什么后面没有了呢，	
	//第一问题：第一个[b]和最后一个[\b]匹配了	
	//解决贪婪问题。U

	$mode = '/(\[b\])(.*)(\[\/b\])/U';
	$replace = '<strong>\2</strong>';
	$string = 'This is a [b]php5[/b],This is a [b]php4[/b]';
	echo preg_replace($mode,$replace,$string);


echo '<hr />';


	//用正则表达式来进行分割
	//如果没有[]符号，就表示，要同时满足
	print_r(preg_split('/[.@]/','yc60.com@gmail.com'));
	

?>