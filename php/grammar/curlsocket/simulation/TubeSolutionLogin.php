<?php

/*TobeSolution.com网站登录开始*/
$url = "http://www.tubesolution.com/index.php?act=login";

$data = array();
$data['Passwd'] = "cx123456";
$data['Email']  = "83595861@qq.com";
$data['btnSubmit'] = "1";
$data['isselect'] = "";

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

var_dump($return);

$pos = strpos($return, "successfully");
if ($pos) {
	echo "登录成功！=====================";
}


/*TobeSolution.com网站发布产品开始*/
$url1 = "http://www.tubesolution.com/index.php?act=admincp_sell&code=add";

$data_add = array();
$data_add['proname']   = "Custom Women Sneakers";
$data_add['keyword1']  = "Women";
$data_add['keyword2']  = "man";
$data_add['keyword3']  = "boy";
$data_add['Photo']     = "";
$data_add['features']  ="Place of Origin: Shandong, China (Mainland)
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
$data_add['period']   = "routine_buy";
$data_add['periodvalue'] = "12";
$data_add['submit']      = "submit";
$data_add['btnSubmit']   = "1";
$data_add['id']          = "1";


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