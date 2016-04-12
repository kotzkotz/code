<?php 

/*
Author:KOP
date:2013-12-5
*/

function smarty_modifier_color($string,$params){
	return '<font style="color:'.$params.'">'.$string.'</font>';
}

?>