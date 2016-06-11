<?php

/*TobeSolution.com网站注册开始*/
$url = "http://www.tubesolution.com/index.php?act=register#";

$data = array();
$data['usertype'] = "0";   
$data['lastname'] = "chen";  
$data['join']     = "";
$data['firstname']= "xiao";
$data['countryid']= "17";
$data['comname']  = "zhejiangshangwu";
$data['btnSubmit']= "1";
$data['accounttype'] = '1';
$data['Passwd']   = "cx123456";
$data['Email']    = "83595861@qq.com";
$data['ChkPasswd']= "cx123456";


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$return  = curl_exec($ch);

curl_close($ch);

$pos = strpos($return, "success");
if ($pos) {
	echo "注册成功！";
}
exit;
?>