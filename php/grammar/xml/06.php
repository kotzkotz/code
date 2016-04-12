<?php

$simxml = simplexml_load_file('./book.xml');

print_r($simxml);

echo '<hr />';

//print_r((array)$simxml);

function ToArray($sim){
	$arr = (array)$sim;
	foreach($arr as $k=>$v){
		if($v instanceof simplexmlelement ||is_array($v)){
			$arr[$k] = ToArray($v);
		}
	}

	return $arr;
}

$xmlarr = ToArray($simxml);

print_r($xmlarr);

echo $xmlarr['book'][0]['price'];

?>