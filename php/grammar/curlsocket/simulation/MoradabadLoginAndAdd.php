<?php

/*moradabadyellowpages.com网站登录开始*/
$url = "http://www.moradabadyellowpages.com/login.php";

$data = array();
$data['us'] = "reanod2016";
$data['ps']  = "19880923";
$data['s1'] = "Login";

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

$pos = strpos($return, "Welcome ");
if ($pos) {
	echo "登录成功！=====================";
}


/*moradabadyellowpages.com网站发布产品开始*/
$url1 = "http://www.moradabadyellowpages.com/addlisting.php";

$data_add = array();
$data_add['CompanyName']   = "HongFuWuXian";
$data_add['CategoryID']  = "6";
$data_add['SubCategoryID']  = "36";
$data_add['logo']  = "";
$data_add['resume'] = "Place of Origin: Shandong, China (Mainland)
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

$data_add['tags'] = "Boys shoots";
$data_add['address1'] = "china.hebei.sjz";
$data_add['phone3'] = "0311-88888888";
$data_add['s1'] = "Add Listing";


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