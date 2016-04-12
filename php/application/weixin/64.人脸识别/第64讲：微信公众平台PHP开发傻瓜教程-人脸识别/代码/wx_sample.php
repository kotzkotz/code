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
				$url = $postObj->PicUrl;
                  $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
 $accesstoken="3.598f24b4f3bc16e360ce2d36c3eaaf9a.2592000.1384963238.282335-808219";//修改为你的token
$urlcode=urlencode($url);    
$faceapi="https://openapi.baidu.com/rest/2.0/media/v1/face/detect?access_token={$accesstoken}&url={$urlcode}";
 $ch = curl_init();//新建curl  
curl_setopt($ch, CURLOPT_URL, $faceapi);//url  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$html = curl_exec($ch);
     

$json=json_decode($html);
$num=$json->face[0]->attribute->gender->value;
     
          
			$contentStr=$num;
          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                echo $resultStr;
				
				
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