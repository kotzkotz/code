<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
				$type = $postObj->MsgType;
				$customevent = $postObj->Event;
				$latitude  = $postObj->Location_X;
				$longitude = $postObj->Location_Y;
                $keyword = trim($postObj->Content);
                $time = time();
                $newsTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<ArticleCount>1</ArticleCount>
				<Articles>
				<item>
				<Title><![CDATA[$keyword]]></Title>
				<Description><![CDATA[%s]]></Description>
				<PicUrl>%s</PicUrl>
				<Url>%s</Url>
				</item>
				</Articles>
				<FuncFlag>0</FuncFlag>
				</xml>";
              $youku=$this->getmovie($keyword);				 
              
           
			 $myresultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time,$youku[intro],$youku[pic],$youku[src]);
              echo $myresultStr;
				
				
				}
				}
				
	private function getmovie($movie){
include("simple_html_dom.php");
$movie=urlencode($movie);
$url="http://www.soku.com/search_video/q_{$movie}";
$html=file_get_html($url);
$div=$html->find('div[class=btnplay_s]',0)->first_child ()->href;
$src=substr($div,29,-5);
$src="http://player.youku.com/embed/".$src;//影片地址
$intro=$html->find('div[class=intro]',0)->plaintext;//影片简介
$pic=$div=$html->find('li[class=p_thumb]',0)->first_child ()->src;
$pic=$pic.".jpg";  //影片图片
return array('intro'=>$intro,'pic'=>$pic,'src'=>$src);
				
		}			
			
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>