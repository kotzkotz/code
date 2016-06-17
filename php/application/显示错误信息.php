<?php

/*
显示错误信息
注：
php碰到致命错误后就不会执行，所以如果查看当前页面致命错误时，需要把显示错误信息的配置放到上级文件，如：

显示错误信息;
include '错误文件';
*/
ini_set('display_errors','On');
ini_set('error_reporting',E_ALL);
error_reporting(E_ALL);



/*
set_error_handler()

http://www.nowamagic.net/librarys/veda/detail/1983/

注意：
E_ERROR、E_PARSE、E_CORE_ERROR、E_CORE_WARNING、 E_COMPILE_ERROR、E_COMPILE_WARNING是不会被这个句柄处理的，也就是会用最原始的方式显示出来。不过出现这些错误都是编译或PHP内核出错，在通常情况下不会发生。
使用set_error_handler()后，error_reporting ()将会失效。也就是所有的错误（除上述的错误）都会交给自定义的函数处理。

*/

//先定义一个函数，也可以定义在其他的文件中，再用require()调用  
function myErrorHandler($errno, $errstr, $errfile, $errline)  
{
	var_dump($errno, $errstr, $errfile, $errline);
	/*
　　//为了安全起见，不暴露出真实物理路径，下面两行过滤实际路径  
    $errfile=str_replace(getcwd(),"",$errfile);  
    $errstr=str_replace(getcwd(),"",$errstr); 
    */

}
set_error_handler('myErrorHandler');  




// 查看php配置
phpinfo();

?>