<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "jiekou");
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
				$j=$postObj->Location_X;
				$w=$postObj->Location_Y;
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[news]]></MsgType>
							 <ArticleCount>1</ArticleCount>
							 <Articles>
							 <item>
							 <Title><![CDATA[本店位置]]></Title> 
							 <Description><![CDATA[按照地图标注来到本店]]></Description>
							 <PicUrl><![CDATA[%s]]></PicUrl>
							 <Url><![CDATA[%s]]></Url>
							 </item>
							 </Articles>
							 <FuncFlag>1</FuncFlag>
							</xml>";             
						
								
				if($MsgType=="location")
				
				{$url="http://api.map.baidu.com/staticimage?width=640&height=320&center=116.725467,23.368905&zoom=16&markers=116.724964,23.36781|{$w},{$j}&markerStyles=l,M,0xFF0000|l,Y,0x008000";
									               
			  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$url,$url);
              echo $resultStr;
                     	
      }else{
                	echo "Input something...";
                }

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