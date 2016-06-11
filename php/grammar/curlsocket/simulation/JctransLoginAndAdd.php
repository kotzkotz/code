<?php

/*jctrans.net网站登录开始*/
$url = "http://www.jctrans.net/login/UserLogin.rails";

$data = array();
$data['UserName'] = "xujian1";
$data['Password']  = "xj123456";
$data['returnBackUrl'] = "/home/index.rails";

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

$pos = strpos($return, "Welcome to use office management system of JCtrans.net");
if ($pos) {
	echo "登录成功！=====================";
}


/*jctrans.net网站发布产品开始*/
$url1 = "http://www.jctrans.net/Express/create.rails";

$data_add = array();
$data_add['Today']   = "2016/5/26";
$data_add['aa']  = "PP";
$data_add['express.Departure']  = "QinHuangDao";
$data_add['express.DepartureCountry']  = "DJIBOUTI";
$data_add['express.Destination']     = "ShiJiazhuang";
$data_add['express.DestinationCountry'] = "AMERICAN SAMOA";
$data_add['express.PaymentTerms'] = "PP";
$data_add['express.Pieces'] = "1000";

$data_add['express.Remark'] = "Place of Origin: Shandong, China (Mainland)
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

$data_add['express.Title'] = "woman  shoots";
$data_add['express.ValidDate'] = "2016-05-26";


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