<?php

/*moradabadyellowpages.com网站注册开始*/
$url = "http://www.moradabadyellowpages.com/register.php";

$data = array();
$data['NewUsername'] = "reanod2015";   
$data['p1'] = "19880923";  
$data['p2']     = "19880923";
$data['FirstName']= "jian";
$data['LastName']= "xu";
$data['address']  = "china.hebei.sjz";
$data['phone']= "0311-88888888";
$data['cellular'] = '15100108598';
$data['email']   = "1276595820@qq.com";
$data['agree']    = "on";
$data['country']= "";
$data['state'] = "uttar pradesh";
$data['city'] = "Moradabad";
$data['zip'] = "244001";
$data['s1'] = "Register Now";

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

$pos = strpos($return, "Congratulations Your Registration Completed Successfully!!");
if ($pos) {
	echo "注册成功！";
}
exit;
?>