<?php

$a=$_GET["keyword"];//获取查询关键词
$d=urlencode(iconv('UTF-8', 'GB2312', "$a"));//转码
$post="v_index=TITLE&v_value={$d}&FLD_DAT_BEG=&FLD_DAT_END=&v_pagenum=10&v_seldatabase=1&v_LogicSrch=0&submit=%B2%E9%26nbsp%3B%D1%AF";  //提交内容
 
$url = "http://218.65.61.76:8001/cgi-bin/IlaswebBib"; //图书馆查询地址 
$ch = curl_init();//新建curl  
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);//post内容  
curl_exec($ch); //输出   
curl_close($ch); 

?>