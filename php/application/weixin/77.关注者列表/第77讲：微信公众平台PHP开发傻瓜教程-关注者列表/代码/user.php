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

//获取关注列表

$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$token}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
$strjson=json_decode($a);
$openidarr= $strjson->data->openid;
echo count($openidarr);
//遍历后获取个人信息
for ($i= 0;$i<count($openidarr); $i++)
{

		$openid=$openidarr[$i];
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid={$openid}";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$a = curl_exec($ch);
	$strjson=json_decode($a);
	$nickname=$strjson->nickname;//获取昵称
	$sex=$strjson->sex;//获取性别
	$city=$strjson->city;//获取城市
	$province=$strjson->province;//获取城市
	$image= $strjson->headimgurl;//获取头像
	//$image=substr($image,0,-1)."96";//换小头像
	$img=file_get_contents($image);//获取远程，防盗链
	$m=$openid.".jpg";//命名头像
	file_put_contents ($m,$img);//存入本地
	include ("conn.php");				
					$sql="INSERT INTO `user` (`id` ,`openid`,`nickname`,`sex`,`city`,`province`,`image`)VALUES (
	NULL ,  '{$openid}','{$nickname}','{$sex}','{$city}','{$province}','{$m}')";
					mysql_query($sql);
echo $i.",";
}


?>



