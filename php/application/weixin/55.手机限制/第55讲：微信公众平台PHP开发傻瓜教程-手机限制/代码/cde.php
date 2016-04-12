<?php

$ch = curl_init();
$url ="abc.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HEADER,1); 
curl_setopt($ch,CURLOPT_USERAGENT,"Windows NT"); 
curl_exec($ch);

?>