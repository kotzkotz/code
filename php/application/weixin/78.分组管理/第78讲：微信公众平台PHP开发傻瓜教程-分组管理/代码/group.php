<?php
//获取token

$appid="";//填写appid
$secret="";//填写secret
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$token = $strjson->access_token;

//查询所有分组
/*
$url = "https://api.weixin.qq.com/cgi-bin/groups/get?access_token={$token}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
echo $a;

//创建分组 男士
$post='{"group":{"name":"男士"}}';
$url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token={$token}";
 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_exec($ch);    
curl_close($ch); 

*/

//移动男士108、女士100
include ("conn.php");
$sql = "SELECT * FROM `user`";
$query=mysql_query($sql);
while($rm=mysql_fetch_array($query))
{
	$openidarr[]=$rm['openid'];
	$sexarr[]=$rm['sex'];
}


 for ($i= 0;$i<count($openidarr); $i++)
{
$openid=$openidarr[$i];
$sex=$sexarr[$i];

if ($sex=="1") 
{$groupid="106";}
else {$groupid="100";}

$b=array("openid"=>$openid,"to_groupid"=>$groupid);
$post=json_encode($b); 

echo $post;
$url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token={$token}";
 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);//url  
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_exec($ch);    
curl_close($ch); 
}
echo "ok";
?>



