<?php

/*kitairu.net网站登录开始*/
$url = "http://kitairu.net/user/";

$data = array();
$data['mail'] = "123456@qq.com";
$data['pass']  = "xj123456";
$data['op'] = "Log in";
$data['previus'] = "";

//cookie文件存放在网站根目录的temp文件夹下
$cookie_file = tempnam('./temp','cookie');


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
// 自动跟随跳转
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);

$return  = curl_exec($ch);

curl_close($ch);

var_dump($return);

$pos = strpos($return, "My account You sign as");
if ($pos) {
	echo "登录成功！=====================";
}


/*jctrans.net网站发布产品开始*/
$url1 = "http://kitairu.net/user/save.html";

$data_add = array();
$data_add['owner_id']   = "2696";
$data_add['text_cn']  = "我公司生产绿色无添加剂安全的绿茶";
$data_add['text_en']  = "Our company produces green tea without additives safe";
$data_add['text_ru']  = "";
$data_add['title_cn']     = "green tea";
$data_add['title_en'] = "green tea";
$data_add['title_ru'] = "green tea";
$data_add['type'] = "products";

$data_add['uid'] = "117931";


$ch1 = curl_init();

curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data_add);
curl_setopt($ch1, CURLOPT_COOKIEFILE, $cookie_file);
// 自动跟随跳转
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);

$return1  = curl_exec($ch1);

curl_close($ch1);

var_dump($return1);

exit;
?>