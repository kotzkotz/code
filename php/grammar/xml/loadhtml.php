<?php
$doc = new DOMDocument('1.0','utf8');
$msn = file_get_contents("./dict.html");
$msn=mb_convert_encoding($msn, 'HTML-ENTITIES', "UTF-8");
$doc->loadHTML($msn);
$xpath = new DOMXPATH($doc);

$sql = "/html/body/h2";
echo $xpath->query($sql)->item(0)->nodeValue,'<br />';

// 查询id="abc"的div节点
$sql = '//div[@id="abc"]';
echo $xpath->query($sql)->item(0)->nodeValue;


// 分析第2个/div/下的p下的相邻span的第2个span的内容
$sql = '//div/p/span[2]';
echo $xpath->query($sql)->item(0)->nodeValue;
?>
