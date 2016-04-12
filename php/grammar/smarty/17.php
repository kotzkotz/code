<?php 

//页面静态化原理
//通过缓冲区

if(file_exists('./01.html')){
	header('location:01.html');
	exit;
}

ob_start();

echo 'a<br />';
echo 'b<br />';
echo 'c<br />';

$html = ob_get_contents();

ob_clean();

//echo $html;

file_put_contents('./01.html',$html);

echo $html;



?>