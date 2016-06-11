<?php

/*adpost.com网站登录开始*/
$url = "http://www.adpost.com/sg/";

$data = array();
$data['auth_logon_op'] = "Login";
$data['auth_password']  = "cx123456";
$data['auth_user_name'] = "zhucong";
$data['http_host'] = "www.adpost.com";
$data['ib_r'] = "http://www.adpost.com/sg/?website=&language=&session_key=8a45dd561fe00398bc9ec6c819d8d1af&logoff=on";
$data['ib_s'] = "a4d81d5a974abaa62bed6ab26369ef9f";
$data['logoff'] = "on";
$data['print_front_page_button'] = "on";

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

$pos = strpos($return, "You Have Logged Out of Your Account");
if ($pos) {
	echo "登录成功！=====================";
}


/*TobeSolution.com网站发布产品开始*/
// $url1 = "http://www.tubesolution.com/index.php?act=admincp_sell&code=add";

$data_add = array();
$data_add['ad_duration']   = "30";
$data_add['add_to_mailing_list']  = "";
$data_add['advertizer']  = "&#32769;&#26495";
$data_add['caption']  = "girls shoots";
$data_add['caption_header']     = "&#25552;&#20379;:";

$data_add['category']  ="&#21046;&#36896;&#19994;";
$data_add['city']   = "";
$data_add['company'] = "";
$data_add['country'] = "&#38463;&#23500;&#27735;";
$data_add['db']      = "sg_business_products_services";
$data_add['display_address']   = "on";
$data_add['email']          = "514583562@qq.com";

$data_add['language'] = "";
$data_add['name'] = "jian xu";
$data_add['new_group'] = "";
$data_add['new_user'] = "";

$data_add['phone'] = "";
$data_add['price'] = "15";
$data_add['price_type'] = "";
$data_add['priority'] = "";
$data_add['qan_boolean'] = "all terms";
$data_add['qan_caption_header'] = "";
$data_add['qan_category'] = "";
$data_add['qan_keywords	'] = "";
$data_add['sectionwide	'] = "";

$data_add['session_key'] = "76535fff449c9596b4f6a586ea124f98";
$data_add['spadid'] = "";
$data_add['spadoption'] = "";
$data_add['spadsection'] = "";

$data_add['state'] = "";
$data_add['street'] = "";
$data_add['submit_addition'] = "on";
$data_add['targeting'] = "";
$data_add['text'] = "Place of Origin: Shandong, China (Mainland)
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

$data_add['url'] = "";
$data_add['visibility'] = "";
$data_add['website'] = "";
$data_add['zip'] = "";


$ch1 = curl_init();

curl_setopt($ch1, CURLOPT_URL, $url);
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