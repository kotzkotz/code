<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
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
                $MsgType=$postObj->MsgType;
				$latitude=$postObj->Location_X;
				$longitude =$postObj->Location_Y;
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							 <ArticleCount>1</ArticleCount>
							 <Articles>
							 <item>
							 <Title><![CDATA[导航]]></Title> 
							 <Description><![CDATA[点击后导航到我的公司]]></Description>
							 <PicUrl><![CDATA[]]></PicUrl>
							 <Url><![CDATA[%s]]></Url>
                            </item>
							</Articles>
							<FuncFlag>0</FuncFlag>
							</xml>";             
						
								
				if($MsgType=="location")
				
				{
                 
				 $url="http://api.map.baidu.com/direction?origin=latlng:{$latitude},{$longitude}|name:你的位置&destination=latlng:23.378341,116.706653|name:我的公司&mode=driving&region=汕头&output=html&src=yourCompanyName|yourAppName";
		
	
					
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$url);
                	echo $resultStr;
                }

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