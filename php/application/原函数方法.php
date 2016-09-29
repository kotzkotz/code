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
 * 文献：
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

?>