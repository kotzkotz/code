
  <?php

require_once('BaeImageService.class.php');
//创建水印操作的对象BaeImageAnnotate
$text = $_GET["number"];
$baeImageAnnotate = new BaeImageAnnotate($text);
$baeImageAnnotate->setFont(BaeImageConstant::MICROHEI,10, '000000');
$baeImageAnnotate->setQuality(80);
$baeImageAnnotate->setPos (130,0 );
//url,暂时只支持url形式
$url = 'http://autoguitar.duapp.com/5.jpg';
//创建服务功能对象
$baeImageService = new BaeImageService();
$retVal = $baeImageService->applyAnnotateByObject($url, $baeImageAnnotate);
 
if($retVal !==false && isset($retVal['response_params']) && isset($retVal['response_params']['image_data'])){
	header("Content-type:image/jpg");
	$imageSrc = base64_decode($retVal['response_params']['image_data']);
	echo $imageSrc;
}else{
	echo 'annotate failed, error:' . $baeImageService->errmsg() . "\n";
}
?>

