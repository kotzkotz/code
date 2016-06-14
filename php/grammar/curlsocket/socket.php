<?php


// stream_context_create()

$out = "POST $path HTTP/1.0\r\n";
$out .= "Accept: */*\r\n";
$out .= "Referer: $boardurl\r\n";
$out .= "Accept-Language: zh-cn\r\n";
$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
$out .= "Host: $host\r\n";
$out .= 'Content-Length: '.strlen($post)."\r\n";
$out .= "Connection: Close\r\n";
$out .= "Cache-Control: no-cache\r\n";
$out .= "Cookie: $cookie\r\n\r\n";
$out .= $post;



?>