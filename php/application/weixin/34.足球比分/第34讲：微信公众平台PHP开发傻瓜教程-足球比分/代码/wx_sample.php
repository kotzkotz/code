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
				if(!empty( $keyword ))
                {
              		include('simple_html_dom.php');
					$html = file_get_html('http://www.zhiboba.cn/');
					foreach($html->find('div#score_1') as $e)//西甲
					   $xistr=$e->plaintext;
					foreach($html->find('div#score_2') as $e)//法甲
					   $fastr=$e->plaintext;
					foreach($html->find('div#score_3') as $e)//意甲
					   $yistr=$e->plaintext; 
					foreach($html->find('div#score_4') as $e)//德甲
					   $destr=$e->plaintext;
					foreach($html->find('div#score_5') as $e)//英超
					   $yingstr=$e->plaintext;
					foreach($html->find('div#score_6') as $e)//中超
					   $zhongstr=$e->plaintext;   
                	switch ($keyword)
					{
					case "西甲";
					$contentStr =$xistr;
					break;
					case "法甲";
					$contentStr =$fastr;
					break;
					case "意甲";
					$contentStr =$yistr;
					break;
					case "德甲";
					$contentStr =$destr;
					break;
					case "英超";
					$contentStr =$yingstr;
					break;
					case "中超";
					$contentStr =$zhongstr;
					break;
					default;
					$contentStr = "请输入西甲、法甲、意甲、德甲、英超、中超查询最新比分!";
								
					
					}
					
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
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