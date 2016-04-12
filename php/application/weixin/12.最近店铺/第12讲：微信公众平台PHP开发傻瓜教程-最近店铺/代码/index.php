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
							 <MsgType><![CDATA[text]]></MsgType>
                             <Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
						
								
				if($MsgType=="location")
				
				{
                 $url1="http://api.map.baidu.com/telematics/v2/distance?waypoints=116.68183799999997,23.353299;{$w},{$j}&ak=1a3cde429f38434f1811a75e1a90310c";
				 $fa1=file_get_contents($url1);
				 $f1=simplexml_load_string($fa1);
				 $ju1=$f1->results->distance;
				 $juli1=intval($ju1);
				 
				 $url2="http://api.map.baidu.com/telematics/v2/distance?waypoints=116.75609199999997,23.46596;{$w},{$j}&ak=1a3cde429f38434f1811a75e1a90310c";
				 $fa2=file_get_contents($url2);
				 $f2=simplexml_load_string($fa2);
				 $ju2=$f2->results->distance;
				 $juli2=intval($ju2);
				 
				 $url3="http://api.map.baidu.com/telematics/v2/distance?waypoints=116.37283100000002,23.549993;{$w},{$j}&ak=1a3cde429f38434f1811a75e1a90310c";
				 $fa3=file_get_contents($url3);
				 $f3=simplexml_load_string($fa3);
				 $ju3=$f3->results->distance;
				 $juli3=intval($ju3);
				 
				 $zuijin=min($juli1,$juli2,$juli3);
				 switch ($zuijin)
						 {
						 case "$juli1";
						 $contentStr = "离你最近的店铺海滨路1好店，电话1111111大约{$zuijin}米";
						 break;
						 case "$juli2";
						 $contentStr="离你最近的店铺澄海区文冠路2号店，电话22222222，大约{$zuijin}米";
						 break;
						 default;
						  $contentStr="离你最近的店揭阳东山大道3号店，电话33333333，大约{$zuijin}米";
						 }
					               
				
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$contentStr);
                	echo $resultStr;
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