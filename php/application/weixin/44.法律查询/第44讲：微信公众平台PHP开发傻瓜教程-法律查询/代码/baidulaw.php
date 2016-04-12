<meta http-equiv="content-type" content="text/html;charset=gb2312">
<?php
include("simple_html_dom.php");
$a=$_GET["keyword"];
$d=urlencode(iconv('UTF-8', 'GB2312', "$a"));
$qurl="http://law.baidu.com/s?tn=baidulaw&cl=0&ct=2097152&si=law.baidu.com&word={$d}";
$htm1=file_get_html($qurl);
$div=$htm1->find('td[class=f]',0);
$link1=$div->find('a',0)->href;
$htm2=file_get_html($link1);
$div2=$htm2->find('td[class=f]',0);

echo $div2;
?>