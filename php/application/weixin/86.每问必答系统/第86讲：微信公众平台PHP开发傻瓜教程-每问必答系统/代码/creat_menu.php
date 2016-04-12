<?php

$appid="";//填写appid
$secret="";//填写secret
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$token = $strjson->access_token;//获取token
$post='
 {
     "button":[
     {	
          "type":"click",
          "name":"开始",
          "key":"begin"
      },
      {
           "type":"click",
           "name":"成绩",
           "key":"score"
      },
      {
           "name":"选项",
           "sub_button":[
           {	
               "type":"click",
               "name":"1",
               "key":"1"
            },
            {
               "type":"click",
               "name":"2",            
			   "key":"2"
            },
            {
               "type":"click",
               "name":"3",
               "key":"3"
            }]
       }]
 }';//创建菜单
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}"; //查询地址 
$ch = curl_init();//新建curl
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);//post内容  
curl_exec($ch); //输出   
curl_close($ch); 

?>