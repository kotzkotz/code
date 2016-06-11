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

// var_dump($return);

$pos = strpos($return, "Welcome to use office management system of JCtrans.net");
if ($pos) {
	echo "登录成功！=====================";
}


/*jctrans.net网站发布产品开始*/
$url1 = "http://www.jctrans.net/OfficeSupply/create.rails";



/*
$data_add = array();
$data_add['SupplyInfo.title']   = "ccadf5555";
$data_add['SupplyInfo.infoName']  = "4f56as456";
$data_add['SupplyInfo.smallclass']  = "Business Services";
$data_add['SupplyInfo.remark']  = "123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a123dsf5a6s4d5f4as56f4a";
$data_add['aa']     = "10";
$data_add['SupplyInfo.periodDays'] = "10";
$data_add['SupplyInfo.SendDays'] = "10";
*/

$data_add = array (
  'SupplyInfo.title' => 'asdfadfs1231',
  'SupplyInfo.infoName' => '12312312',
  'SupplyInfo.smallclass' => 'Agriculture',
  'SupplyInfo.remark' => 'asdfasdf5as6d4f56ads4f56as4df65',
  'aa' => '10',
  'SupplyInfo.periodDays' => '10',
  'SupplyInfo.unit' => '',
  'SupplyInfo.price' => '',
  'SupplyInfo.minNum' => '',
  'SupplyInfo.totalNum' => '',
  'SupplyInfo.SendDays' => '10',
);


$ch1 = curl_init();

curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch1, CURLOPT_REFERER, 'http://www.jctrans.net/OfficeSupply/new.rails');
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data_add);
curl_setopt($ch1, CURLOPT_COOKIEFILE, $cookie_file);
// 自动跟随跳转
// curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
// curl_setopt($ch1, CURLOPT_AUTOREFERER, 1);


/*

curl_setopt ($ch, CURLOPT_REFERER, "http://www.csair.com/ "); //模拟来源  
curl_setopt($ch, CURLOPT_URL, $url);//URL  
curl_setopt($ch, CURLOPT_POST, 1);  //模拟POST  
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);//POST内容  
curl_exec($ch);  
curl_close($ch);  

*/


$return1  = curl_exec($ch1);

curl_close($ch1);

var_dump($return1);

exit;
?>