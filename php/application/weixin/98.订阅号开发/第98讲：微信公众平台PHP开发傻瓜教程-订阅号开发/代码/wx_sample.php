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
				$Evnetkey=$postObj->Eventkey;		        
		        $keyword = trim($postObj->Content);
			    $time = time();				
				$mysql = new SaeMysql();
			switch ($type)
			{   case "event":
				 switch($Event){
				 case "subscribe":
				   $contentStr = "关注";
				   $sql="INSERT INTO  `dingyue` (`id` ,`openid`)VALUES (
NULL ,  '{$fromUsername}')";
				   $mysql->run($sql);
				   break;
				 case "unsubscribe":
				   $contentStr = "取消关注";
				    $sql="DELETE FROM `dingyue` WHERE `openid` = '{$fromUsername}';";
				   $mysql->run($sql);
				   break;
				  case "CLICK":
				    switch($Evnetkey){
					case "1":
					 $contentStr = "自定义菜单";
					break;
					
					}
				   break; 
				 }
				break;
				case "image":
             $contentStr = "图片";
             break;
             case "video":
             $contentStr = "视频";
				break;
				case "location":
				$contentStr="地理";				
				break;
				case "link" :
				$contentStr = "链接！";
				break;
				case "voice" :
              $contentStr = "声音";
				break;
				case "text":
				  switch($keyword)
				  {
                    case "1";              					
					$contentStr = "1";
					 $sql="UPDATE `dingyue` SET `menu`='1'where `opeind`= '{$fromUsername}'";
				   $mysql->run($sql);
					break;
					case "2";
                	$contentStr = "2";
					break;
					default;
					$sql="SELECT * FROM `dingyue` where where `opeind`= '{$fromUsername}'";
					$data = $mysql->getData($sql);
					$menu=$data[0][menu];
				//二级菜单处理
					if($menu=="1"){
						
						
						}
					
					
				  }
				  
	            }
		$textTpl = "<xml>
							<ToUserName>$fromUsername</ToUserName>
							<FromUserName>$toUsername</FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content>$contentStr</Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
		echo $textTpl;
		
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