<?php

$word = isset($_GET['word'])?trim($_GET['word']):'';

if(empty($word)){
	echo '请输入你要查询的单词';
	exit;
}

$xml = new DOMDocument('1.0','utf-8');

$xml->load('./dict.xml');

$xpath = new DOMXpath($xml);

$sql = '/dict/word[name="'.$word.'"]/name';

//echo $sql;

$m = $xpath->query($sql);

if($m->length == 0){
	echo '没找到';
	exit;
}

//print_r($m);

echo $word,'<br />';
echo $m->item(0)->nextSibling->nodeValue,'<br />';
echo $m->item(0)->nextSibling->nextSibling->nodeValue,'<br />';

?>