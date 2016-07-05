<?php

$str = uniqid();

if($_POST){

$data = array();

$data['op'] = 'B2BLogin';
$data['userName'] = 'shijiazhuangre5';
$data['userPassword'] = 'woshimima';


$cookie_file=$_POST['cookie'];

$cookie_file2=uniqid();

$url = 'http://my.en.china.cn/admin.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
// 设置头信息
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language:zh-CN,zh;q=0.8\nHost:www.ec51.com\nOrigin:http://www.ec51.com\nReferer:http://www.ec51.com/join.html\nX-Requested-With:XMLHttpRequest"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// 接收新的cookie
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file2);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$return  = curl_exec($ch);
curl_close($ch);


var_dump($return);exit;









// 发布产品
$data = array();
$data['tradeLeadType'] = '0';
$data['quantity'] = '0';
$data['offerDetail'] = '<p>jsadoifjasldfjlkasdfjl</p>';
$data['offerSubject'] = 's4adf5632';
$data['modelNO'] = '4sa6fd';
$data['keyword1'] = 'f4dsa56';
$data['keyword2'] = 'f4dsa56';
$data['keyword3'] = 'f4dsa56';
$data['productPrice'] = '16';
$data['priceUnit'] = '';
$data['minAmount'] = '';
$data['totalAmount'] = '';
$data['port'] = '';
$data['quality'] = '';
$data['brandName'] = '';
$data['currency'] = '';
$data['priceTerms'] = '';
$data['otherPriceTerms'] = '';
$data['paymentTerms'] = '';
$data['paymentRemark'] = '';
$data['deliverDate'] = '';
$data['totalAmountUnit'] = '';
$data['packaging'] = 'woshibaozhuang';
$data['needExProp'] = '1';
$data['categoryType'] = 'SELL';
$data['select'] = '302';
$data['categoryId'] = '302';
$data['placeOfOrigin'] = 'shijazhuang';
$data['watermarker'] = 'on';
$data['picIndex'] = '2';
$data['offerExpire'] = '90';
$data['retread'] = '1';


$cookie_file3=uniqid();
$url = 'http://my.en.china.cn/admin.php?op=SellInfoPublish&auth=3822bdc1161e083ebec643567ec0e338';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// 发送cookie
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file2);

$return  = curl_exec($ch);
curl_close($ch);

var_dump($return);



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