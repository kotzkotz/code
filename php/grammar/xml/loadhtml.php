<?php
$doc = new DOMDocument('1.0','utf8');
$msn = file_get_contents("./dict.html");
$msn=mb_convert_encoding($msn, 'HTML-ENTITIES', "UTF-8");
$doc->loadHTML($msn);
$xpath = new DOMXPATH($doc);

$sql = "/html/body/h2";
echo $xpath->query($sql)->item(0)->nodeValue,'<br />';

// ��ѯid="abc"��div�ڵ�
$sql = '//div[@id="abc"]';
echo $xpath->query($sql)->item(0)->nodeValue;


// ������2��/div/�µ�p�µ�����span�ĵ�2��span������
$sql = '//div/p/span[2]';
echo $xpath->query($sql)->item(0)->nodeValue;
?>
