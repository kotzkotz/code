<?php

/*trade2bharat.com网站注册开始*/
$url = "http://www.trade2bharat.com/addmember.php";

$data = array();
$data['city'] = "shijiazhuang";   
$data['country'] = "38";  
$data['email']     = "83595861@qq.com";
$data['fax']= "86";
$data['fax1']= "0311";
$data['fax2']  = "88888888";
$data['firstname']= "jian";
$data['lastname'] = 'xu';
$data['mobile']   = "15100108598";
$data['other_state']    = "china";
$data['password']= "19880923";
$data['phone'] ="86";
$data['phone1'] = "0311";
$data['phone2'] ="88888888";
$data['pwd2'] = "19880923";
$data['state'] = "";
$data['street'] = "xinhuaquxisanzhuangjie";
$data['submit'] ="注册";
$data['username'] = "xujian";
$data['zip_code'] = "050000";


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$return  = curl_exec($ch);

curl_close($ch);

var_dump($return);
exit;

$pos = strpos($return, "success");
if ($pos) {
	echo "注册成功！";
}
exit;
?>