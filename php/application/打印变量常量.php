<?php

//获取所有可用的变量
$arr = get_defined_vars();
print_r($arr);

//获取所有可用的常量
$arr = get_defined_constants(true)
print_r($arr);

//获取所有可用的函数
$arr = get_defined_functions()
print_r($arr);

//获取所有可用的类
$arr = get_declared_classes()
print_r($arr);

//获取所有可用的模块
$arr = get_loaded_extensions()
print_r($arr);

//获取指定模块的可用函数
$arr = get_extension_funcs('gd');
print_r($arr);

?>