<?php

echo '当前工作目录：'.getcwd() . "<br/>";
echo '当前文件目录：'.dirname(__FILE__);

/*
ps:
include 'a.php'
会先寻找当前工作目录的a.php，如果没有会继续寻找当前文件当前文件目录的a.php，如果都有则会选择当前工作目录的a.php
include './a.php'
只会寻找当前工作目录的a.php
*/

?>