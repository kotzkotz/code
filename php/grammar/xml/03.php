<?php

$dom = new DOMDocument('1.0','utf-8');
$dom->load('01.xml');

$tl = $dom->getElementsByTagName('title')->item(0);
$tl->parentNode->removeChild($tl);

/*
header('content-type:text/xml');
echo $dom->savexml();
*/

$title = $dom->getElementsByTagName('title')->item(0);
$xqj = $dom->createTextnode('寻秦记');

$title->replaceChild($xqj,$title->firstChild);

//$title->appendChild($xqj);


header('content-type:text/xml');
echo $dom->savexml();



?>