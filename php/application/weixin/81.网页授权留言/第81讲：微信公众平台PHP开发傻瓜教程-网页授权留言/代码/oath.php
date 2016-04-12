<?php
$appid="";//ÌîÐ´appid

$re="http://xxxx.duapp.com/oath2.php";//userinfo»Øµ÷
$re=urlencode($re);
$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$re}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

echo $url;


?>
