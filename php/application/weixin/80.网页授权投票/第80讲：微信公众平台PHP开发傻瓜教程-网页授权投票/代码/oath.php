<?php
$appid="";//ÌîÐ´appid


$basere="http://xxx.duapp.com/oath1.php";//»Øµ÷µØÖ·
$basere=urlencode($basere);

$baseurl="https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$basere}&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
echo $baseurl;

?>
