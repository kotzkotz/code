<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

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
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content>%s</Content>
							<FuncFlag>0</FuncFlag>
							</xml>"; 
			   include("coon.php");            
				
				if($keyword=="8")
				{
				$array=array("第5页第1个字"=>"王","第8页第1个字"=>"李","第30页第1个字"=>"周");
				$a=array_rand($array,1);
				$b=$array[$a];
				$contentStr=$a."是什么？";
				$sql="INSERT INTO `menu2` (`id` ,`user` ,`sec`,`answer`)VALUES (NULL ,  '{$fromUsername}',  '8','{$b}')";
                  mysql_query($sql);
				}   
			
		else{
		$sql="SELECT * FROM `menu2` where `user`= '{$fromUsername}'";
				$query=mysql_query($sql);
				$rm=mysql_fetch_array($query);
				$sec=$rm['sec'];
				$answer=$rm['answer'];		
		if($sec=="8")
		{
          if($keyword==$answer)
		  {$contentStr="你的答案是正确的，视频代码下载地址为....";
	     	}
		else
	    	{$contentStr="你的答案不正确，请购买《微信公众平台搭建与开发揭秘》";
		    }
		}
		else 
		{$contentStr="请先输入8";
		}
		}
				$msgType="text";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
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