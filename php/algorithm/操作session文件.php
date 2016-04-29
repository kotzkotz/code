<?php

// 读取session文件
function unserialize_php($session_data){
    $return_data = array();
    $offset = 0;
    while ($offset < strlen($session_data)) {
        if (!strstr(substr($session_data, $offset), "|")) {
            throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
        }
        $pos = strpos($session_data, "|", $offset);
        $num = $pos - $offset;
        $varname = substr($session_data, $offset, $num);
        $offset += $num + 1;
        // unserialize类似于字符串转化成数字如：'156asdf'转成数字后为156，只转化到碰到第一个不能转化的位置
        $data = unserialize(substr($session_data, $offset));
        $return_data[$varname] = $data;
        $offset += strlen(serialize($data));
    }
    return $return_data;
}

// 写入session文件
function serialize_php($session_data){
    $str = '';
    foreach($session_data as $k=>$v){
        $str .= $k.'|'.serialize($v);
    }
    return $str;
}