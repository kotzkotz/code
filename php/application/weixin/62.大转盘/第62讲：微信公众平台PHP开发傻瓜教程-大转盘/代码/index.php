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
		                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
				$type = $postObj->MsgType;
				$customrevent = $postObj->Event;
				$latitude  = $postObj->Location_X;
				$longitude = $postObj->Location_Y;
                $keyword = trim($postObj->Content);
                $time = time();
				include("conn.php");
                         
				if ($type=="event" and $customrevent=="subscribe")
			{   
				  $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content>感谢</Content>
							<FuncFlag>0</FuncFlag>
							</xml>";      
                
                 $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time);
                echo $resultStr;                  
				$sql="INSERT INTO `menu` (`id` ,`user`,`score`)VALUES (
NULL ,  '{$fromUsername}','100')";
                mysql_query($sql);	
						
					}
					
				
				  if($keyword=="1")
				  {
                   $sql="SELECT * FROM `menu` where `user`= '{$fromUsername}'";
				$query=mysql_query($sql);
				$rm=mysql_fetch_array($query);
				$uid=$rm['user'];
			
                	$newsTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							 <Articles>
							 <item>
							 <Title>大转盘</Title> 
							 <Description><![CDATA[大转盘]]></Description>
							 <PicUrl></PicUrl>
							 <Url>http://jiekouphp.duapp.com/ka.php?uid=$uid</Url>
							 </item>
                             </Articles>
							<FuncFlag>1</FuncFlag>
							</xml>";       		
			
				$resultStr = sprintf($newsTpl,$fromUsername,$toUsername,$time);
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