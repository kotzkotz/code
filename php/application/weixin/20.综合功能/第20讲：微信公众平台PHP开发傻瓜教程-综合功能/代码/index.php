<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "jiekou");
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
                $keyword = trim($postObj->Content);
                $time = time();
				$j=$postObj->Location_X; 
				$w=$postObj->Location_Y; 
				$type=$postObj->MsgType;				
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
				$newsTpl="<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							 <Articles>
							 <item>
							 <Title><![CDATA[图文信息]]></Title> 
							 <Description><![CDATA[图文信息]]></Description>
							 <PicUrl><![CDATA[%s]]></PicUrl>
							 <Url><![CDATA[%s]]></Url>
							 </item>
							 </Articles>
							<FuncFlag>0</FuncFlag>
							</xml>";
				$musicTpl="<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[music]]></MsgType>
							<Music>
							 <Title><![CDATA[TITLE]]></Title>
							 <Description><![CDATA[DESCRIPTION]]></Description>
							 <MusicUrl><![CDATA[http://jiekouphp.duapp.com/1.mp3]]></MusicUrl>
							 <HQMusicUrl><![CDATA[http://jiekouphp.duapp.com/1.mp3]]></HQMusicUrl>
 						    </Music>
							<FuncFlag>0</FuncFlag>
							</xml>";	
							
				switch ($type){
				case "event";
				$contentStr = "感谢你的关注，回复1公司简介，2公司图片，3听音乐，发送手机图片看评价，发送位置信息看周边地图";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
               	break;
				case "text";
				        switch($keyword){
						case "1";
						$contentStr = "我公司....";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
						break;
						case "2";
						$a="http://jiekouphp.duapp.com/1.jpg";
						$b="http://www.baidu.com";
						$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time,$a,$b);
						break;
						case "3";
						$resultStr = sprintf($musicTpl, $fromUsername, $toUsername, $time);
						break;
						default;
						$contentStr = "回复1公司简介，2公司图片，3听音乐，发送手机图片看评价，发送位置信息看周边地图";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
						}
			  break;
			  case "image";
			   $contentStr = "图片不错，80分";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
				break;
			  case "location";
			   	$a="http://api.map.baidu.com/staticimage?width=640&height=320&center={$w},{$j}&zoom=16";
				$b="http://api.map.baidu.com/marker?location={$w},{$j}&output=html";
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time,$a,$b);
				break;
			    case "link";
			    $contentStr = "感谢你的分享，不是病毒吧";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
				break;
			  default;
			   	$contentStr = "这项功能还没开发";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
			    
     }
  	echo $resultStr;
               

        }else {
        	echo "";
        	exit;
        }
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