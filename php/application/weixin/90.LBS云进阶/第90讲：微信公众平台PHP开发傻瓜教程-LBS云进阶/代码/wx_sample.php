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
                $keyword = trim($postObj->Content);
		        $time = time();
				$type=$postObj->MsgType;
                $Event= $postObj->Event;
		        $Latitude= $postObj->Location_X;
				$Longitude= $postObj->Location_Y;
		        $keyword = trim($postObj->Content);
			    $time = time();
				
				
			if($type=="location"){
		$url="http://api.map.baidu.com/geosearch/v3/nearby?ak=7f8d2303e868c2e29facc89de962f684&geotable_id=52557&q=&location={$Longitude},{$Latitude}&radius=5000&sortby=distance:1";
		$urlobj=file_get_contents($url);//读入文件
		$json=json_decode($urlobj);//json解析
		$name=$json->contents[0]->title;//楼盘
		$address=$json->contents[0]->address;//地址
		$pic=$json->contents[0]->pic->big;//图片
		$price=$json->contents[0]->price;//
		$desc="地址".$address."价格".$price;
		$textTpl = "<xml>
							<ToUserName>$fromUsername</ToUserName>
							<FromUserName>$toUsername</FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
<item>
<Title><![CDATA[$name]]></Title> 
<Description><![CDATA[$desc]]></Description>
<PicUrl><![CDATA[$pic]]></PicUrl>
<Url><![CDATA[ ]]></Url>
</item>
							<FuncFlag>0</FuncFlag>
							</xml>";    
		echo $textTpl;
				
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