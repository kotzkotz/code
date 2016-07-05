<?php

$str = uniqid();

if($_POST){

$data = array();
$data['uname'] = '3233816752';
$data['passwd'] = '3233816752@qq.com';
$data['remember'] = 'Y';
$data['imgcode'] = $_POST['yzm'];







$cookie_file=$_POST['cookie'];

$cookie_file2=uniqid();

$url = 'http://www.ec51.com/login.html';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
// 设置头信息
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language:zh-CN,zh;q=0.8\nHost:www.ec51.com\nOrigin:http://www.ec51.com\nReferer:http://www.ec51.com/join.html\nX-Requested-With:XMLHttpRequest"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// 发送cookie
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
// 接收新的cookie
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file2);

/*
BBBmmyr_sajfdlkjd
BBBmmyr_Gs0s
CewoI_03k
*/

$return  = curl_exec($ch);
curl_close($ch);
if($return=='{"code":1,"message":"Login successfully.","jump":"\/ucp\/"}'){
	echo '登录成功！';
}else{
	var_dump($return);
}








}









?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>登录</title>
	<script src="http://www.ec51.com/js/jquery.js"></script>
</head>
<body>

<form action="" method="post">
	验证码：<input type="text" name='yzm' />
	<input type="hidden" name="cookie" value="<?php echo $str?>" />
	<img src="./1.php?str=<?php echo $str?>"/>
	<input type="submit" value="提交" />
</form>
</body>
</html>