<?php

$a = "array('a','b','c')";

var_dump($a);

eval('$b='.$a.';');
eval("\$c=$a;");

var_dump($b);
var_dump($c);

?>