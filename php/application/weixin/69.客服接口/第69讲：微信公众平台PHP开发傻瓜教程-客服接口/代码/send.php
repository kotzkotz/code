<?php


    
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

//主动回复
$fromUsername="ovUyZjjhTEZTz0wk1uj44kVr4zpI";
  $contentStr="hello,my 爸爸"; 
	 $contentStr=urlencode($contentStr);
/*
$post='{
    "touser":"$fromUsername",
    "msgtype":"text",
    "text":
    {
         "content":"Hello World"
    }
}';
      
$a=array("content"=>"{$contentStr}");
     $b=array("touser"=>"{$fromUsername}","msgtype"=>"text","text"=>$a);
$post=json_encode($b); 
$post=urldecode($post);
/*
$post="{
    \"touser\":\"$fromUsername\",
    \"msgtype\":\"text\",
    \"text\":
    {
         \"content\":\"Hello World中国\"
    }
}";
/*
$post="{
    \"touser\":\"$fromUsername\",
    \"msgtype\":\"news\",
    \"news\":{
        \"articles\": [
         {
             \"title\":\"Happy Day\",
             \"description\":\"Is Really A Happy Day\",
             \"url\":\"URL\",
             \"picurl\":\"PIC_URL\"
         },
         {
             \"title\":\"Happy Day\",
             \"description\":\"Is Really A Happy Day\",
             \"url\":\"URL\",
             \"picurl\":\"PIC_URL\"
         }
         ]
    }
}";
*/
$a1=array("title"=>"$contentStr","description"=>"Is Really A Happy Day","url"=>"url","picurl"=>"picurl");
$a2=array("title"=>"Happy Day","description"=>"Is Really A Happy Day","url"=>"url","picurl"=>"picurl");
$d=array($a1,$a2);
$a=array("articles"=>$d);
     $b=array("touser"=>"{$fromUsername}","msgtype"=>"news","news"=>$a);
$post=json_encode($b); 
$post=urldecode($post);


$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$token}";
 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_exec($ch);    
curl_close($ch); 

      
   
?>