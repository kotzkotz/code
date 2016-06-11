<?php

$key = 'AIzaSyCmsDqmScSy2TNVbRRxDxll2RWTt3TxyzQ';  
$cx = '014669375805372418625:hpevqrxmf-0';  
$q = 'A-line';  
$url = 'https://www.googleapis.com/customsearch/v1?'.'&fields=items(link)&key='.$key.'&cx='.$cx.'&q='.$q.'&d=10&alt=json';

// $url = 'https://www.googleapis.com/customsearch/v1?&key=AIzaSyCmsDqmScSy2TNVbRRxDxll2RWTt3TxyzQ&cx=014669375805372418625:hpevqrxmf-0&q=A-line&d=10&alt=json';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
$data = curl_exec($curl);
curl_close($curl);
$data = json_decode($data,true);
print_r($data);

?>