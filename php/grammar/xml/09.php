<?php

header("content-type:text/html; charset=utf-8");

$html = new DOMDocument('1.0','utf-8');
$html->loadhtmlfile('dict.html');

$xpath = new DOMXPATH($html);
$sql = '/html/body/h2';
var_dump($xpath->query($sql)->item(0)->nodeValue);

//获取页面内容
echo file_get_contents('dict.html');
echo '汉字';



/*
function loadNprepare($url,$encod='') {
        $content = file_get_contents($url);
        if (!empty($content)) {
                if (empty($encod))
                        $encod = mb_detect_encoding($content);
                $headpos = mb_strpos($content,'<head>');
                if (FALSE=== $headpos)
                        $headpos= mb_strpos($content,'<HEAD>');
                if (FALSE!== $headpos) {
                        $headpos+=6;
                        $content = mb_substr($content,0,$headpos) . '<meta http-equiv="Content-Type" content="text/html; charset='.$encod.'">' .mb_substr($content,$headpos);
                }
                $content=mb_convert_encoding($content, 'HTML-ENTITIES', $encod);
        }
        $dom = new DomDocument;
        $res = $dom->loadHTML($content);
        if (!$res) return FALSE;
        return $dom;
}

$dom = loadNprepare('dict.html','utf-8');

$xpath = new DOMXPATH($dom);
$sql = '/html/body/h2';
echo $xpath->query($sql)->item(0)->nodeValue,'<br />';


// 查询id="abc"的div节点
$sql = '//div[@id="abc"]';
echo $xpath->query($sql)->item(0)->nodeValue;


// 分析第2个/div/下的p下的相邻span的第2个span的内容
$sql = '//div/p/span[2]';
echo $xpath->query($sql)->item(0)->nodeValue;
*/



?>