<?php

set_time_limit(0);

require('./http.class.php');

$http = new Http('http://a50.photo.store.qq.com/psu?/216253102/KyyrP4s.mVv5HtgN*lMlK.50HMlCFzs16eA9VN8kMt4!/i/Yaqd2R1EFgAAYjvVeR5*FgAA&a=50&b=51&bo=4AF.AQAAAAABALk!&rf=photolist');

//print_r($http);

//$http->setHeader('Referer: http://user.qzone.qq.com/304400612/infocenter?ptsig=M6aw0kiTB0*KDVLF-KfoNSp5O*Xxr15iWyJuu4WVOKE_');

//echo $http->get();

$res = $http->get();

file_put_contents('./bb.png',substr(strstr($res,"\r\n\r\n"),4));

echo 'ok';

?>