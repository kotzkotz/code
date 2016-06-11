<?php

/*jctrans.net网站注册开始*/
$url = "http://www.jctrans.net/Register/Register_New_Add.rails";

$data = array();
$data['ComType'] = "Sea Shipping";   
$data['confirmpassword'] = "xj123456";  
$data['introduction']     = "";
$data['qnalification']= "ISO 9000";
$data['users.Category']= "";
$data['users.City']  = "china.hebei.sjz";
$data['users.ComName']= "zhejiangshangwu";
$data['users.Country'] = 'CHINA';
$data['users.Fax']   = "";
$data['users.FirstName']    = "xujian1";
$data['users.JobTitle']= "Senior Management";
$data['users.Phone'] = "86-0311-88888888";
$data['users.Street'] = "xinhuaquxisanzhuangdajie";
$data['users.Zip'] = "050000";
$data['users.branches'] = "1";

$data['users.email'] = "as4df48fa4ds5@qq.com";
$data['users.empnum'] = "1";
$data['users.homepage'] = "";
$data['users.introduction'] = "zhejiangshangwu Established Year 2015-01-01 
							   Mainly engaged in wholesale and retail shoes";

$data['users.istype'] = "0";
$data['users.msn'] = "";
$data['users.password'] = "xj123456";
$data['users.regdate'] = "2015";
$data['users.sex'] = "Male";
$data['users.skype'] = "";
$data['users.username'] = "xujian12311";
$data['users.yahoo'] = "";

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
var_dump($return);exit;
$pos = strpos($return, "You have successfully registered with JCtrans.");
if ($pos) {
	echo "注册成功！";
}
exit;
?>