<?php

$a = array('a','b','c');

$str = '<?php return '.var_export($a,true).'?>';

file_put_contents('a.php',$str);

$b = include 'a.php';

var_dump($b);

?>