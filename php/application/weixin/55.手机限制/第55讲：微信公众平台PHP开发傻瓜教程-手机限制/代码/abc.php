<?php

$b=$_SERVER[HTTP_USER_AGENT];
$a="/Windows NT/";
echo $b;

if (preg_match($a,$b))
{
 echo "非法访问!";
}else{
    header("Location: http://www.sina.com.cn");
}

?>
