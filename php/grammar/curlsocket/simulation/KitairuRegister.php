<?php

/*http://kitairu.net网站注册开始*/
$url = "http://kitairu.net/cn/user/register.html";

$data = array();
$data['contact_name'] = "xujian1";   
$data['mail'] = "123456@qq.com";
$data['op']     = "注册";
$data['pass']= "xj123456";
$data['pass_2']= "xj123456";
$data['previus']  = "";
$data['role']= "1";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// 自动跟随跳转
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);

$return  = curl_exec($ch);

curl_close($ch);

var_dump($return);

/*此网站没有明显的注册成功标示，经过测试注册一般都会成功，后期可根据是否可以登录确定注册成功与否*/

// $pos = strpos($return, "You have successfully registered with JCtrans.");
// if ($pos) {
// 	echo "注册成功！";
// }
exit;
?>