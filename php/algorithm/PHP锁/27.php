<?php


/*
$file = "temp.txt";   
$fp = fopen($file , 'r');   
echo fread($fp , 100);   
fclose($fp); 
*/




$file = "temp.txt";   
$fp = fopen($file , 'r');   
if(flock($fp , LOCK_EX)){   
	echo fread($fp , 100);   
	flock($fp , LOCK_UN);   
} else{   
    echo "Lock file failed...\n";   
}



fclose($fp);



/*

$file = "temp.txt";   
$fp = fopen($file , 'r');   
if(flock($fp , LOCK_SH | LOCK_NB)){   
    echo fread($fp , 100);   
    flock($fp , LOCK_UN);   
} else{   
    echo "Lock file failed...\n";   
}   
fclose($fp);

*/



?>