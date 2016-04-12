<?php

/***
====笔记部分====
用DOM来创建XML文档

1:先创建"天龙八部"文本节点
2:再创建普通的name节点
3:再把天龙文本节点,加入到name节点中

4:创建cdata节点,
5:创建intro节点
6:再把cdata节点放入intro中

7:创建goods节点
8:把name,intro放入goods节点

9:创建属性节点goods_id
10:把属性节点放入goods节点

11:创建appstore节点
12:把goods放入appstore节点

13:把appsotore放入文档中

***/

$dom = new DOMDocument('1.0','utf-8');

$tl = $dom->createTextNode('天龙八部');

$name = $dom->createElement('name');

$name->appendChild($tl);

$cdata = $dom->createCDATASection('这真是极好的！');

$intr = $dom->createElement('intro');

$intr->appendChild($cdata);

$goods = $dom->createElement('goods');

$goods->appendChild($name);
$goods->appendChild($intr);

$attr = $dom->createAttribute('goods_id');
$attr->value = 'j001';

$goods->appendChild($attr);

$appstore = $dom->createElement('appstore');
$appstore->appendChild($goods);

$dom->appendChild($appstore);


header('content-type: text/xml');
echo $dom->savexml();


//echo $dom->save('02.xml')?'OK':'FAIL';



?>