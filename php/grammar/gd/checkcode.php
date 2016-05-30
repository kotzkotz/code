<?php

session_start();

$enablegd = 1;
$funcs = array('imagecreatetruecolor','imagecolorallocate','imagefill','imageline','imagedestroy','imagecolorallocatealpha','imageellipse','imagepng');
foreach($funcs as $func)
{
	if(!function_exists($func))
	{
		$enablegd = 0;
		break;
	}
}
if(!function_exists('ob_gzhandler')) ob_clean();

if($enablegd)
{
function getAuthImage($text) {
	$im_x = 160;
	$im_y = 40;
	$im = imagecreatetruecolor($im_x,$im_y);
	$text_c = ImageColorAllocate($im, mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
	$tmpC0=mt_rand(100,255);
	$tmpC1=mt_rand(100,255);
	$tmpC2=mt_rand(100,255);
	$buttum_c = ImageColorAllocate($im,$tmpC0,$tmpC1,$tmpC2);
	imagefill($im, 16, 13, $buttum_c);

	$font = PHPCMS_ROOT.'include/fonts/ARIALNI.TTF';

	for ($i=0;$i<strlen($text);$i++)
	{
		$tmp =substr($text,$i,1);
		$array = array(-1,1);
		$p = array_rand($array);
		$an = $array[$p]*mt_rand(1,10);//角度
		$size = 28;
		imagettftext($im, $size, $an, 15+$i*$size, 35, $text_c, $font, $tmp);
	}


	$distortion_im = imagecreatetruecolor ($im_x, $im_y);

	imagefill($distortion_im, 16, 13, $buttum_c);
	for ( $i=0; $i<$im_x; $i++) {
		for ( $j=0; $j<$im_y; $j++) {
			$rgb = imagecolorat($im, $i , $j);
			if( (int)($i+20+sin($j/$im_y*2*M_PI)*10) <= imagesx($distortion_im)&& (int)($i+20+sin($j/$im_y*2*M_PI)*10) >=0 ) {
				imagesetpixel ($distortion_im, (int)($i+10+sin($j/$im_y*2*M_PI-M_PI*0.1)*4) , $j , $rgb);
			}
		}
	}
	//加入干扰象素;
	$count = 160;//干扰像素的数量
	for($i=0; $i<$count; $i++){
		$randcolor = ImageColorallocate($distortion_im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		imagesetpixel($distortion_im, mt_rand()%$im_x , mt_rand()%$im_y , $randcolor);
	}

	$rand = mt_rand(5,30);
	$rand1 = mt_rand(15,25);
	$rand2 = mt_rand(5,10);
	for ($yy=$rand; $yy<=+$rand+2; $yy++){
		for ($px=-80;$px<=80;$px=$px+0.1)
		{
			$x=$px/$rand1;
			if ($x!=0)
			{
				$y=sin($x);
			}
			$py=$y*$rand2;

			imagesetpixel($distortion_im, $px+80, $py+$yy, $text_c);
		}
	}

	//设置文件头;
	Header("Content-type: image/JPEG");

	//以PNG格式将图像输出到浏览器或文件;
	ImagePNG($distortion_im);

	//销毁一图像,释放与image关联的内存;
	ImageDestroy($distortion_im);
	ImageDestroy($im);
}

function make_rand($length="32"){//验证码文字生成函数
	$str="abcdefhijkmnpqrstuvwxy345678FGHIJKL";
	$result="";
	for($i=0;$i<$length;$i++){
		$num[$i]=rand(0,25);
		$result.=$str[$num[$i]];
	}
	return $result;
}


//输出调用
$checkcode = make_rand(4);

$_SESSION['checkcode']=strtolower($checkcode);
getAuthImage($checkcode);


}
else
{
	$files = glob(PHPCMS_ROOT.'images/checkcode/*.jpg');
	if(!is_array($files)) exit($LANG['please_check_dir_images_checkcode']);
	$checkcodefile = $files[rand(0, count($files)-1)];
	$_SESSION['checkcode'] = substr(basename($checkcodefile), 0, 4);
	header("content-type:image/jpeg\r\n");
	include $checkcodefile;
}

?>