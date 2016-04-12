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
		        $keyword = trim($postObj->Content);
			    $time = time();
				
				if($type=="text"){

$mysql = new SaeMysql();
$sql="SELECT * FROM `jiaohao` where `openid`= '{$fromUsername}'";
$data = $mysql->getData($sql);
$user=$data[0][openid];
 if (empty($user))
{
$sql="INSERT INTO `jiaohao` (`id` ,`openid`)VALUES (NULL ,'{$fromUsername}')";
$mysql->runSql($sql); 
$sql="SELECT * FROM  `jiaohao` WHERE  `openid` =  '{$fromUsername}'";
$data = $mysql->getData($sql);}
$id=$data[0][id];
$id=intval($id);
$c = new SaeCounter();
$jiao=$c->get('jiao'); 
$num=$id-$jiao;
	       $reply="你的排号是".$id."当前是".$jiao."号，前面还有".$num."人"; 
	            $textTpl = "<xml>
							<ToUserName>$fromUsername</ToUserName>
							<FromUserName>$toUsername</FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content>$reply</Content>
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