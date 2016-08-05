<?php
// 也可以用curl函数
header("Content-type:text/html;charset=utf-8");

// 线上
$remote_file = fopen("http://localhost/ceshi/xiazai/temp.zip", 'r');

// 下载地址
$dir = "D:/WWW/ceshi/xiazai/";
$file_name = date('Ymd').'.zip';
$local_file = fopen($dir.$file_name, 'w');


while (!feof($remote_file)) {
    fwrite($local_file,fgets($remote_file, 1024),1024);
}
fclose($local_file);
fclose($remote_file);



if (extension_loaded('zip')) {
    echo 'php自带扩展<br />';
    $tpl_zip = new ZipArchive();
    $tpl_zip->open($dir.$file_name);
    $tpl_zip->extractTo("D:/WWW/ceshi/xiazai/");
    $tpl_zip->close();
} else {
    echo 'php手写插件<br />';
    if (!file_exists("D:/WWW/ceshi/xiazai/")) {
        mkdir("D:/WWW/ceshi/xiazai/", 0755);
    }
    include 'zip.php';
    $zipper = new zipper();
    $zipper->ExtractTotally($dir.$file_name,"D:/WWW/ceshi/xiazai/");
}
unlink($dir.$file_name);



echo 'ok';

?>