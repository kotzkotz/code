<?php

$a=$_GET["keyword"];//获取查询关键词
$post="queryType=flightNum&flightNum={$a}";  //提交内容
$url = "http://eb.csair.com/flightQuery/fltQueryETicketResultN.jsp"; //查询地址 
$ch = curl_init();//新建curl
curl_setopt ($ch, CURLOPT_REFERER, "http://www.csair.com/ "); //模拟来源
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);//post内容  
curl_exec($ch); //输出   
curl_close($ch); 

?>