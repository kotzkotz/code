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
	
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
				$type = $postObj->MsgType;
				$customrevent = $postObj->Event;
				$latitude  = $postObj->Location_X;
				$longitude = $postObj->Location_Y;
                $keyword = trim($postObj->Content);
				 $mediaid = $postObj->MediaId;//获取图片、语音、视频id
               $ThumbMediaId=$postObj->ThumbMediaId;//获取视频缩略图
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content>%s</Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				switch ($type)
			{   
                case "video";
                $contentStr = $mediaid."视频".$ThumbMediaId;//通过此方法输出得到id，服务器保存3日
                        
				break;
				case "voice" ;//发送语音时回复语音信息
			$soundtpl="<xml>
						<ToUserName>$fromUsername</ToUserName>
						<FromUserName>$toUsername</FromUserName>
						<CreateTime>$time</CreateTime>
						<MsgType><![CDATA[voice]]></MsgType>
						<Voice>
						<MediaId><![CDATA[k_F4l_iQUGueiGmxHgWP73ko6kX_8ojjUeQZGptEkPQ2oRl1Bbikb575vCddCJac]]></MediaId>
						</Voice>
						</xml>";
				echo $soundtpl;
				break;
				case "text";
				  switch($keyword)
				  {
                    case "1";              					
					$contentStr = "回复1查看使用说";
					break;
					case "5";//回复视频信息
				$videotpl="<xml>
				<ToUserName>$fromUsername</ToUserName>
				<FromUserName>$toUsername</FromUserName>
				<CreateTime>$time</CreateTime>
				<MsgType><![CDATA[video]]></MsgType>
				<Video>
				<MediaId><![CDATA[nWNwBqJ-5APEAv4kh-9-BLeV27kq2sIgSr1N4wrEso6KUBpvmU_2mbsdboBofo8l]]></MediaId>
				<ThumbMediaId><![CDATA[wDnFXB59IkHg59CvyI6hHCtIJv0Y6V3OnSnDh1-xvAcNdOY70a7x4IJlmQUc51Vb]]></ThumbMediaId>
				</Video>
				</xml>";
				echo $videotpl;
                break;					
				}				
				}
			
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,  $contentStr);
                echo $resultStr;
                
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