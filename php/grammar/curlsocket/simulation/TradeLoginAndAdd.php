<?php

/*trade2bharat.com网站登录开始*/
$url = "http://www.trade2bharat.com/login.php";

$data = array();
$data['es_type'] = "0";
$data['id']  = "0";
$data['return_path'] = "";
$data['username'] = "xujian";
$data['pwd'] = "19880923";
$data['Submit'] = "Sign In";

//cookie文件存放在网站根目录的temp文件夹下
$cookie_file = tempnam('./temp','cookie');


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

$return  = curl_exec($ch);

curl_close($ch);

$pos = strpos($return, "you have successfully logged-in");
if ($pos) {
	echo "登录成功！=====================";
}


/*trade2bharat.com网站发布产品开始*/
$url1 = "http://www.trade2bharat.com/post_product.php";

$data_add = array();
$data_add['category']   = "Agriculture>Others";
$data_add['cats']  = "0";
$data_add['cid']  = "90";
$data_add['es_cash']  = "yes";
$data_add['es_delivery_time']     = "30";

$data_add['es_description'] = "Place of Origin: Shandong, China (Mainland)
					 Brand Name:GLORY Model Number:	GF-CB2015029
					 Gender:	Boys Upper Material:Canvas
					 Lining Material:Cotton Fabric
					 Insole Material:EVA
					 Outsole Material:Rubber
					 Style:Slip-On
					 Season:	Autumn, Spring, Summer
					 Upper:canvas / pu /other textile
					 Lining:	cotton / textile, per your request
					 Insole:	EVA+ Cotton
					 Outsole:Rubber
					 Color:	red, yellow,navy,black,any color can do,per your request
					 Feature:Fashion,Casual,Comfortable
					 Origin:	Qingdao, China
					 Port:Qingdao
					 MOQ:1000 pairs per style per color per gender
					 Size:children: EUR:28--35#/women:EUR:36-41#/men:EUR:39-45
					 http://www.gloryfootwearco.com";

$data_add['es_keywords'] = "red   tea";
$data_add['es_location'] = "china";
$data_add['es_min_order'] = "10";
$data_add['es_other_mode'] = "";
$data_add['es_price'] = "10";
$data_add['es_price_cur_id'] = "7";
$data_add['es_product_status'] = "New";
$data_add['es_quantity'] = "100";
$data_add['es_samples_available'] = "no";
$data_add['es_shipping_cost'] = "10";
$data_add['es_title'] = "red tea";
$data_add['submit'] = "Post Now";


$ch1 = curl_init();

curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data_add);
curl_setopt($ch1, CURLOPT_COOKIEFILE, $cookie_file);

$return1  = curl_exec($ch1);

curl_close($ch1);

var_dump($return1);

exit;
?>