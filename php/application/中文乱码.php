<?php

$a = '中文';

// 5Lit5paH \u4e2d\u6587 %E4%B8%AD%E6%96%87
/*
base64_encode($a)       5Lit5paH
json_encode($a)         \u4e2d\u6587 #json采用默认unicode
urlencode($a)           %E4%B8%AD%E6%96%87
*/

var_dump(base64_encode($a),json_encode($a),urlencode($a));

?>