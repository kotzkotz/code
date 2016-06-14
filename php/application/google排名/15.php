<?php  
        // 初始化一个 cURL 对象  
$curl = curl_init();  
$key = 'AIzaSyCmsDqmScSy2TNVbRRxDxll2RWTt3TxyzQ';  
$cx = '014669375805372418625:hpevqrxmf-0';  
$q = 'A-line';  
$url = 'https://www.googleapis.com/customsearch/v1?'.'&key='.$key.'&cx='.$cx.'&q='.$q.'&d=10&alt=json';

// 设置你需要抓取的URL  
curl_setopt($curl, CURLOPT_URL, $url);  
// 设置header  
curl_setopt($curl, CURLOPT_HEADER, 0);  
// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// 忽略ssh验证
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// 运行cURL，请求网页  
$data = curl_exec($curl);  
// 关闭URL请求  
curl_close($curl);  
// 显示获得的数据  
var_dump($data);  
// Parse json data  
$json = json_decode($data);  
if(isset($json)) {  
    echo $json->items[0]->title;  
} else {  
    echo 'json is null.';  
}  
?>