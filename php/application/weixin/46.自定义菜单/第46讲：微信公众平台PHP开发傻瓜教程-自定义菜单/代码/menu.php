<?php

$appid="";//填写appid
$secret="";//填写secret

$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);


$strjson=json_decode($a);
$token = $strjson->access_token;
$post="{
     \"button\":[
     {	
          \"type\":\"click\",
          \"name\":\"账号介绍\",
          \"key\":\"V1001_TODAY_ME\"
      },
           {
           \"name\":\"菜单\",
           \"sub_button\":[
            {
               \"type\":\"click\",
               \"name\":\"hello word\",
               \"key\":\"V1001_HELLO_WORLD\"
            },
            {
               \"type\":\"click\",
               \"name\":\"赞一下我们\",
               \"key\":\"V1001_GOOD\"
            }]
       }]
 }";  //提交内容
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}"; //查询地址 
$ch = curl_init();//新建curl
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);//post内容  
curl_exec($ch); //输出   
curl_close($ch); 

?>