<?php

$file = "temp.txt";

$fp = fopen($file , 'r');   
if(flock($fp , LOCK_EX)){
	sleep(5);
	$num = fread($fp,1024);
	flock($fp , LOCK_UN);   
}
fclose($fp);

$fp = fopen($file , 'a');
if(flock($fp , LOCK_EX)){
	for($i=1;$i<5;$i++){
		fwrite($fp,$i);
		sleep(1);
	}

	flock($fp , LOCK_UN);   
}
fclose($fp);

?>