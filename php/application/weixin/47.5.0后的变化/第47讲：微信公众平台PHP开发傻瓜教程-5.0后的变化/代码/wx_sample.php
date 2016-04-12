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
				$keyword = trim($postObj->Content);
				$j=$postObj->Location_X;
				$w=$postObj->Location_Y;
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[news]]></MsgType>
							 <ArticleCount>2</ArticleCount>
							 <Articles>
							 <item>
							 <Title><![CDATA[汕头地区天气预报]]></Title> 
							 <Description><![CDATA[]]></Description>
							 <PicUrl><![CDATA[http://t3.baidu.com/it/u=3777927806,1458438373&fm=21&gp=0.jpg]]></PicUrl>
							 <Url><![CDATA[]]></Url>
							 </item>
							 <item>
							 <Title><![CDATA[%s]]></Title>
							 <Description><![CDATA[]]></Description>
							 <PicUrl><![CDATA[%s]]></PicUrl>
							 <Url><![CDATA[]]></Url>
							 </item>							 
							 </Articles>
							 <FuncFlag>1</FuncFlag>
							</xml>";             
						
								
				
				$url="http://m.weather.com.cn/data/101280501.html";//天气网api:http://flash.weather.com.cn/wmaps/xml/china.xml
				
				 $fa=file_get_contents($url);
				 $weather = json_decode($fa);
				 $da1=$weather->weatherinfo->temp1;//温度
				 $da2=$weather->weatherinfo->weather1;//天气 
             	 $da3=$weather->weatherinfo->img1;//图片编号		
				 $d1=$da1.$da2;
				 $pic="http://m.weather.com.cn/img/b{$da3}.gif";			               
			   $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$d1,$pic);
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