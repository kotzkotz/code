<?php

/*www.adpost.com网站注册开始*/
$url = "http://www.adpost.com/sg/";
$username = "zhucong";

$data = array();
$data['auth_company']    = "";   
$data['auth_country']    = "Singapore";  
$data['auth_email']      = "83595861@qq.com";
$data['auth_first_name'] = "cong";
$data['auth_gender']     = "1";

$data['auth_last_name']  = "zhu";
$data['auth_password1']  = "cx123456";
$data['auth_password2']  = 'cx123456';
$data['auth_phone']      = "";
$data['auth_register_op']= "Submit Information";

$data['auth_state']      = "Northern Singapore";
$data['auth_street']     = "";
$data['auth_url']        = "";
$data['auth_user_name']  = $username;
$data['auth_zip']        = "";

$data['http_host']       = "www.adpost.com";
$data['logoff']          = "on";
$data['update_profile_button'] = "on";


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$return  = curl_exec($ch);

curl_close($ch);

var_dump($return);

$pos = strpos($return, $username.", put a Photo and Profile Description (About You) on your account!");
if ($pos) {
	echo "注册成功！";
}
exit;
?>