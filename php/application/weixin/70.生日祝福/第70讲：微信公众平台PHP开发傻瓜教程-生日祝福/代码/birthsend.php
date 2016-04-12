<?php

include "conn.php";

$date=date("mj");//m为月 j为日期
echo $date;
$sql = "SELECT * FROM `birth` WHERE  `date` = '{$date}'";
$query=mysql_query($sql);



while($rs=mysql_fetch_array($query))
{
$fromUsername[]=$rs['openid'];
  print_r($fromUsername);
}

//符合条件的保存在数组$fromUsername


    
//获取token

$appid="wxf51c0709078e1bee";//填写appid
$secret="873a00bb4465f498821d6067a98a2766";//填写secret
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$token = $strjson->access_token;

$contentStr="今天是你的生日，祝你生日快乐"; 
$contentStr=urlencode($contentStr);
        
 foreach($fromUsername as $openid){

echo $openid;
$a=array("content"=>"{$contentStr}");
$b=array("touser"=>"{$openid}","msgtype"=>"text","text"=>$a);
$post=json_encode($b); 
$post=urldecode($post);
$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$token}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_exec($ch);    
curl_close($ch); 
echo "send success";
}
  
   
?>