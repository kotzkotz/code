<?php

$num = 10;
$filename = "temp.txt";

$fp = fopen($filename, "a");

if(flock($fp, LOCK_EX)){
	for ($i = 0; $i < $num; $i++) {
	    fwrite($fp, "process1: " . $i . "\r\n");
	    sleep(1);
	}
}

fclose($fp);

?>