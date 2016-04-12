<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "Cns");
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
			$Recognition= $postObj->Recognition;
                $time = time();
                 //百度翻译

          $tranurl="http://openapi.baidu.com/public/2.0/bmt/translate?client_id=9peNkh97N6B9GGj9zBke9tGQ&q={$Recognition}&from=auto&to=auto";//百度
                $transtr=file_get_contents($tranurl);//读入文件
		$transon=json_decode($transtr);//json解析
	        $contentStr = $transon->trans_result[0]->dst;//读取翻译内容
		$contentStr=URLENCODE($contentStr);	//转url
       //获取语音文件    
$ch = curl_init();
$URL="http://tts-api.com/tts.mp3?q={$contentStr}&return_url=1";
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$mp3url=curl_exec($ch);
					$musictpl = "<xml>
							<ToUserName>$fromUsername</ToUserName>
							<FromUserName>$toUsername</FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType>music</MsgType>
							<Music>
							<Title>$Recognition</Title>
                            <Description>$contentStr</Description>
							<MusicUrl>$mp3url</MusicUrl>
							<HQMusicUrl>$mp3url</HQMusicUrl>
							</Music>
</xml>"; 
				
			
                echo $musictpl;
                
	
        
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