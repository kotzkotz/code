<?php

header("Content-type: text/html; charset=utf-8");

$simxml = simplexml_load_file('book.xml');

//print_r($simxml);
$sons = $simxml->children();

//print_r($sons);

foreach($sons as $v){
	echo $v->getName(),'<br />';
}




?>