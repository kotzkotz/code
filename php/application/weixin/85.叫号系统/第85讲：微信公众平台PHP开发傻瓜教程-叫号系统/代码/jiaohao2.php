<?php
$id=$_GET["id"];
$change=$_GET["change"];
$change=intval($change);
if($id=="1"){
$c = new SaeCounter();
$c->incr('jiao'); 
$num=$c->get('jiao'); 
echo $num;//加1后返回当前计数

$mysql = new SaeMysql();
$sql="SELECT * FROM `jiaohao` where `id`= '{$num}'";
$data = $mysql->getData($sql);
$user=$data[0][openid];
$id=$data[0][id];
include("token.php");
$contentStr="现在轮到你了，请尽快和服务员联系"; 
$contentStr=urlencode($contentStr);//转码urlencode，避免json转码成unicode       
$a=array("content"=>"{$contentStr}");
$b=array("touser"=>"{$user}","msgtype"=>"text","text"=>$a);
$post=json_encode($b); 
$post=urldecode($post);//解码
$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$token}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);  
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_exec($ch);    
curl_close($ch); 
}

if(!empty($change)){
	$c = new SaeCounter();
	$c->set('jiao',$change);
	}
//修改后返回计数	
?>