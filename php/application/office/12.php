<?php

/*

使用前准备：
1、必须开启COM扩展：
	extension=php_com_dotnet.dll
	com.allow_dcom = true
2、必须安装 OpenOffice.org 软件：
	http://www.openoffice.org/

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
$doc_file = $str . 'D:/WWW/xcs/aa2.xlsx';
$output_file = $str . 'D:/WWW/xcs/aa2.pdf';

// word2pdf($doc_file,$output_file);
echo 'ok';







//word转html
function word2html($wordname,$htmlname) 
{ 
	$word = new COM("word.application") or die("Unable to instanciate Word"); 
	// $word->Visible = 1;
	$word->Documents->Open($wordname);
	var_dump($word->Documents[1]);
	$word->Documents[1]->SaveAs($htmlname,8); 
	$word->Quit(); 
	$word = null; 
	unset($word); 
}


// $doc_file = 'D:\WWW\xcs\aa3.doc';
$doc_file = 'E:\aa3.doc';
$output_file = 'D:\WWW\xcs\aa3.html';

word2html($doc_file,$output_file);

echo 'ok';exit;




// 读取word内容
// 建立一个指向新COM组件的索引
$word = new COM("word.application") or die("Can't start Word!"); 
// 显示目前正在使用的Word的版本号 
//echo “Loading Word, v. {$word->Version}<br>”; 
// 把它的可见性设置为0（假），如果要使它在最前端打开，使用1（真） 
// to open the application in the forefront, use 1 (true) 
//$word->Visible = 0; 
//打开一个文档 
$str = 'E:\aa3.doc';
$word->Documents->OPen("$str");
//读取文档内容 
$test= $word->ActiveDocument->content->Text; 
echo $test; exit;
//将文档中需要换的变量更换一下 
$test=str_replace("<{变量}>","这是变量",$test); 
echo $test; 
$word->Documents->Add(); 
// 在新文档中添加文字 
$word->Selection->TypeText("$test"); 
//把文档保存在目录中 
$word->Documents[1]->SaveAs("d:/myweb/comtest.doc"); 
// 关闭与COM组件之间的连接 
$word->Quit();
?>