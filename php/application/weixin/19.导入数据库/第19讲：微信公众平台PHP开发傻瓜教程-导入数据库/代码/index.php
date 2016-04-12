<?php
/**
  * wechat php test
  */

//define your token
function chaxun($a){
$dbname = 'iJwoEEToOKqMjzeIWmOd';
						$host = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
						$port = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
						$user = getenv('HTTP_BAE_ENV_AK');
						$pwd = getenv('HTTP_BAE_ENV_SK');
						/*接着调用mysql_connect()连接服务器*/
						$link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
						if(!$link) {
							die("Connect Server Failed: " . mysql_error($link));
						   }
						/*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
						if(!mysql_select_db($dbname,$link))
						 {
							die("Select Database Failed: " . mysql_error($link));
						 }							 
						 
						 mysql_query("set names GBK",$link); 

$sql="SELECT `DQ` FROM `shenfen` WHERE `BM`='" . iconv("UTF-8","GBK",$a) . "'";
 $query=mysql_query($sql);
 $rs=mysql_fetch_array($query);
 $c= $rs['DQ'];
 $b=iconv("GBK","UTF-8",$c);
 if (empty($b))  $b="对不起,没";
return $b;
mysql_close($link);
}
define("TOKEN", "jiekou");
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
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty($keyword ))
									
								
                {
					$msgType = "text";
	               
				$contentStr= chaxun($keyword);
						 
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
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