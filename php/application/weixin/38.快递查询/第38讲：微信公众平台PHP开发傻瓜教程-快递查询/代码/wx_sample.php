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
				$customrevent = $postObj->Event;
				$latitude  = $postObj->Location_X;
				$longitude = $postObj->Location_Y;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				switch ($type)
			{  
				case "text";
				$status=array('0'=>'查询出错','1'=>'暂无记录','2'=>'在途中','3'=>'派送中','4'=>'已签收','5'=>'拒收','6'=>'疑难件','7'=>'退回');//构建快递状态数组
				$kuaidiurl="http://www.aikuaidi.cn/rest/?key=ff4735a30a7a4e5a8637146fd0e7cec9&order={$keyword}&id=shentong&show=xml";//快递地址
                $kuaidistr=file_get_contents($kuaidiurl);//读入文件
				$kuaidiobj=simplexml_load_string($kuaidistr);//xml解析
				$kuaidistatus = $kuaidiobj->Status;//获取快递状态
				$kuaistr=strval($kuaidistatus);//对象转换为字符串
				$contentStr0 =$status[$kuaistr];//根据数组返回
				foreach ($kuaidiobj->Data->Order as $a)
				 {	
				 foreach ($a->Time as $b)
				   {
					foreach ($a->Content as $c)
					{$m.="{$b}{$c}";}
					}
				 }
				//遍历获取快递时间和事件
				$contentStr="你的快递单号{$keyword}{$contentStr0}{$m}";
				break;					
			default;
			$contentStr ="此项功能尚未开发";	
			}
				$msgType="text";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
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