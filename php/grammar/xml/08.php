<?php

$xml = new DOMDocument('1.0','utf-8');
$xml->load('book.xml');

$xpath = new DOMXPATH($xml);

/*
$sql = '/bookstore/book[price>40]/title';
echo $xpath->query($sql)->item(0)->nodeValue;
*/

$sql = '/bookstore/book[title="侠客行"]/price';

echo $xpath->query($sql)->item(0)->nodeValue;




?>