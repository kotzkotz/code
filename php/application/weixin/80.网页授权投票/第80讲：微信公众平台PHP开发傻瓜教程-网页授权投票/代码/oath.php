<?php
$appid="";//��дappid


$basere="http://xxx.duapp.com/oath1.php";//�ص���ַ
$basere=urlencode($basere);

$baseurl="https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$basere}&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
echo $baseurl;

?>
