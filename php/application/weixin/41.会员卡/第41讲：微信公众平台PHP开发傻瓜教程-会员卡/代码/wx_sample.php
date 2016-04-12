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
                $keyword = trim($postObj->Content);
                $time = time();
               
			   include("coon.php");            
			
				
				if ($keyword=="会员卡")
				
				{
				
				$sql="SELECT * FROM `num` ";
					 $query=mysql_query($sql);
					 $rm=mysql_fetch_array($query);
					 $number=$rm['number'];
                
               $newsTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<ArticleCount>1</ArticleCount>
				<Articles>
				<item>
				<Title><![CDATA[领取会员卡]]></Title>
				<Description><![CDATA[点击链接领取会员卡]]></Description>
				<PicUrl>http://autoguitar.duapp.com/5.jpg</PicUrl>
				<Url>http://autoguitar.duapp.com/ka.php?number=$number</Url>
				</item>
				</Articles>
				<FuncFlag>0</FuncFlag>
				</xml>";
				 
				 $number++;
				 $sql2="UPDATE `num` SET `number`={$number}";
                     mysql_query($sql2);
                  
           
			 $myresultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time);
              echo $myresultStr;
				
				}
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