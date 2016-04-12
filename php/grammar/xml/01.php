<?php 

$dom = new DOMDocument('1.0','utf-8');

$dom->load('./01.xml'); 

$ts = $dom->getElementsByTagName('title');

//print_r($ts);//DOMNodeList Object ( )

echo '这个对象有',$ts->length,'个长度';

//print_r($ts);//DOMNodeList Object ( )

$title0 = $ts->item(0);

print_r($title0->childNodes);//DOMNodeList Object ( )

echo $title0->childNodes->length;//1

$text = $title0->childNodes->item(0);

print_r($text); //DOMText Object ( )

$str = $text->wholeText;

echo $str; //天龙八部

var_dump($str);

echo '<hr />';

echo $dom->getElementsByTagName('title')->item(0)->childNodes->item(0)->wholeText;

echo '<hr />';

echo $dom->getElementsByTagName('title')->item(0)->nodeValue;

?>