<?php

/*

功能介绍office->pdf->swf
                pdf->png


使用前准备：
1、开启COM扩展：
    extension=php_com_dotnet.dll
	com.allow_dcom = true
2、安装 OpenOffice.org 软件（office转成pdf）：
	http://www.openoffice.org/
3、安装 swftools 软件 （pdf转swf格式）：
    http://www.swftools.org/
4、安装 ImageMagick （图片之间格式转化），测试：打开cmd，输入convert出现帮助文档
    http://imagemagick.org/script/binary-releases.php#windows
5、如果ImageMagick需要pdf转成png则需要安装 Ghostscript
    http://www.ghostscript.com/download/gsdnld.html
6、安装 php_imagick.dll（没安装成功，使用system，exec）
    extension=php_imagick.dll
    下载地址 http://pecl.php.net/package/imagick/3.1.2/windows

7、重启电脑，只重启apache不管用。因为软件是在扩展底层使用的，所以重启电脑，重新加载软件，并刷新path路径

ps：第六步补充
将php_imagick.dll放入php的ext目录下。
下载时，请注意non-thread-safe和thread-safe，前者适用于IIS，后者适用于Apache。
首先是装完ImageMagick，一定要配置环境变量，PATH当中安装的时候可以勾选装上，另外还要添加一个 MAGICK_HOME=C:\ImageMagick\modules\coders，这里可以根据自己的安装目录自行调整
然后就是解压imagick扩展包的时候，有一堆其余的dll文件，要复制到C:\Windows\System32里，如果是64位的复制到C:\Windows\SysWOW64里 然后cmd里运行下php -v，看看有没有报错，如果有报错的，看看是不是漏装了VC库，成功的话，重启下IIS，再运行phpinfo()看看，正常的话，就可以看到imagick加载成功了，如果看到supported formats是no value的话，看下环境变量是否添加了。
*/

set_time_limit(0);
function MakePropertyValue($name,$value,$osm){
    $oStruct = $osm->Bridge_GetStruct("com.sun.star.beans.PropertyValue"); 
    $oStruct->Name = $name; 
    $oStruct->Value = $value; 
    return $oStruct; 
} 
function word2pdf($doc_url, $output_url){ 
    //Invoke the OpenOffice.org service manager 
    $osm = new COM("com.sun.star.ServiceManager") or die ("Please be sure that OpenOffice.org is installed.\n"); 
    //Set the application to remain hidden to avoid flashing the document onscreen 
    $args = array(MakePropertyValue("Hidden",true,$osm)); 
    //Launch the desktop 
    $top = $osm->createInstance("com.sun.star.frame.Desktop"); 
    //Load the .doc file, and pass in the "Hidden" property from above 
    $oWriterDoc = $top->loadComponentFromURL($doc_url,"_blank", 0, $args); 
    //Set up the arguments for the PDF output 
    $export_args = array(MakePropertyValue("FilterName","writer_pdf_Export",$osm)); 
    //Write out the PDF 
    $oWriterDoc->storeToURL($output_url,$export_args); 
    $oWriterDoc->close(true); 
}

/*

使用方法：
1、地址前必须加上地址协议：'file:///'；
2、地址必须为左斜杠'/'

*/
$str = 'file:///';
// 源文件
$word = 'D:/NewConsultantFile/Website_Information_Form.doc';
// 要转成pdf文件的路径
$pdf = 'D:/WWW/ceshi/aa2.pdf';
// 要转成swf文件的路径
$swf = 'D:/WWW/ceshi/aa2.swf';

$doc_file = $str . $word;
$output_file = $str . $pdf;

// office转成pdf格式
word2pdf($doc_file,$output_file);

// pdf转成swf格式
$command = 'E:/pdf2swf/pdf2swf.exe -i '.$pdf.' -o '.$swf;
// system,exec
$result = exec($command);
if ($result){
    // 加入flash控制器
    $command = 'E:/pdf2swf/swfcombine.exe E:/pdf2swf/swfs/rfxview.swf viewport='.$swf.' -o '.$swf;
    exec($command);
}

// pdf转成png格式
// 转化pdf的第一页
$pdf = 'D:/WWW/ceshi/aa2.pdf[0]';
// png的保存路径
$png = 'D:/WWW/ceshi/aa2.png';
// convert位置以及参数
$convert = 'E:/imagemagick/ImageMagick-6.7.5-Q16/convert -resize 110x164';
// 拼接系统指令
$sys = $convert.' "'.$pdf.'" "'.$png.'"';
// 执行
var_dump(system($sys));

?>