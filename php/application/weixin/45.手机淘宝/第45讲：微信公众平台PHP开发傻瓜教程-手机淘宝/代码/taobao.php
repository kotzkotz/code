<?php
$keyword=$_GET["keyword"];
$keyword=urlencode($keyword);
$post="q={$keyword}&suid=82165238&event_submit_do_search_auction=%E5%BA%97%E5%86%85%E6%90%9C%E7%B4%A2";//自己的淘宝店
$url = "http://shop.m.taobao.com/shop/shop_auction_search.htm?_input_charset=utf-8"; //查询地址 
$ch = curl_init();//新建curl
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);//post内容  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); //重新定向
curl_exec($ch); //输出   
curl_close($ch);      

?>