<?php

// 本函数可以查到函数定义的文件位置，或者对象方法的定义位置，有利于对追踪学习开源代码

function a() {
}

class b {
    public function f() {
    }
}

function function_dump($funcname) {
    try {
        if(is_array($funcname)) {
            $func = new ReflectionMethod($funcname[0], $funcname[1]);
            $funcname = $funcname[1];
        } else {
            $func = new ReflectionFunction($funcname);
        }
    } catch (ReflectionException $e) {
        echo $e->getMessage();
        return;
    }
    $start = $func->getStartLine() - 1;
    $end =  $func->getEndLine() - 1;
    $filename = $func->getFileName();
    echo "function $funcname defined by $filename($start - $end)\n";
}
function_dump('a');
function_dump(array('b', 'f'));
$b = new b();
function_dump(array($b, 'f'));
?>