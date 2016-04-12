<?php

$appid="wx7ced2a8593275753";//填写appid
$secret="71f475563d00103a356943875e96d43a";//填写secret
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
          "name":"我要咨询",
          "key":"consult"
      },
      {
           "type":"click",
           "name":"我的案件",
           "key":"case"
      },
      {
           "name":"律所介绍",
           "sub_button":[
           {	
               "type":"view",
               "name":"微网站",
               "url":"http://1.fswange.sinaapp.com/weiwang.html"
            },
            {
               "type":"view",
               "name":"律所导航",            "url":"http://1.fswange.sinaapp.com/daohang.html"
            },
            {
               "type":"click",
               "name":"常见问题",
               "key":"ques"
            }]
       }]
 }';//创建菜单
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}"; 
$ch = curl_init();//新建curl
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);//post内容  
curl_exec($ch); //输出   
curl_close($ch); 

?>