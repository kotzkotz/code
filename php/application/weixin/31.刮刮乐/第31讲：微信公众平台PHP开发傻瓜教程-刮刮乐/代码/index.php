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
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							 <ArticleCount>1</ArticleCount>
							 <Articles>
							 <item>
							 <Title><![CDATA[刮刮乐刮出大奖]]></Title> 
							 <Description><![CDATA[]]></Description>
							 <PicUrl><![CDATA[http://jiekouphp.duapp.com/image/ggl.jpg]]></PicUrl>
							 <Url><![CDATA[%s]]></Url>
							 </item>
							 </Articles>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				            		
               	$a=rand(1,4);
                switch ($a)
				 {
				 case "1";
				 $b="http://jiekouphp.duapp.com/image/1.html";
				 break;
				 case "2";
				 $b="http://jiekouphp.duapp.com/image/2.html";
				 break;
				 case "3";
				 $b="http://jiekouphp.duapp.com/image/3.html";
				 break;
				 default;
				 $b="http://jiekouphp.duapp.com/image/4.html";							 
				 }
                	
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $b);
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