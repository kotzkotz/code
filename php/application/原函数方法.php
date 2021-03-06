<?php

/*
 * 功能：原函数方法，根据函数或者类或者类的方法找到所在文件的具体位置，ReflectionClass和ReflectionMethod有的时候可以通用（具体版本没有测试）
 * @author zckop
 * @param string,obj string表示函数或者类，具体的根据第二个参数判断，obj表示类
 * @param bool,string false表示是函数，true表示是类，string表示类的方法
 * 使用案例：
 * 函数：		zc_dump('function');
 * 类：			zc_dump('class',true);
 * 实例方法：	zc_dump(class,'method');
 * 静态方法：	zc_dump('class','method');
 * 文献：http://ee1.php.net/manual/zh/class.reflectionclass.php
 * 函数：
	$function = new ReflectionFunction('function');
	$filename = $function->getFileName();
	$start = $function->getStartLine();
	$end =  $function->getEndLine();
	echo $filename.'('.$start.','.$end.')';
 * 类：
	$class = new ReflectionClass('class');
	$filename = $class->getFileName();
	$start = $class->getStartLine();
	$end =  $class->getEndLine();
	echo $filename.'('.$start.','.$end.')';
 * 实例方法
	$class = new ReflectionMethod(class,'method');
	$filename = $class->getFileName();
	$start = $class->getStartLine();
	$end =  $class->getEndLine();
	echo $filename.'('.$start.','.$end.')';
 * 静态方法
	$class = new ReflectionClass('class');
	echo $class->getMethod('method');
 */
function zc_dump($so,$class=false){

	$sign = false;

	if($class == false){
		$func = new ReflectionFunction($so);
	}else{
		if(is_string($so)){
			$sign = true;
			$func = new ReflectionClass($so);
		}else{
			$func = new ReflectionMethod($so,$class);
		}
	}

	if($sign && $class !== true){
		return $func->getMethod($class);
	}

	$filename = $func->getFileName();
	$start = $func->getStartLine();
	$end =  $func->getEndLine();
	return $filename.'('.$start.','.$end.')';
	
}



/*
 * debug_backtrace
 * 功能：产生一条回溯跟踪
 * 文献：http://php.net/manual/zh/function.debug-backtrace.php
 */
// filename: /tmp/a.php
function a_test($str)
{
    echo "\nHi: $str";
    var_dump(debug_backtrace());
}

a_test('friend');

// filename: /tmp/b.php
include_once '/tmp/a.php';

/*
// 访问/tmp/b.php，等到一下信息
Hi: friend
array(2) {
[0]=>
array(4) {
    ["file"] => string(10) "/tmp/a.php"
    ["line"] => int(10)
    ["function"] => string(6) "a_test"
    ["args"]=>
    array(1) {
      [0] => &string(6) "friend"
    }
}
[1]=>
array(4) {
    ["file"] => string(10) "/tmp/b.php"
    ["line"] => int(2)
    ["args"] =>
    array(1) {
      [0] => string(10) "/tmp/a.php"
    }
    ["function"] => string(12) "include_once"
  }
}

*/

?>