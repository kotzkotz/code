<?php
/**
  * wechat php test
  */

//define your token
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
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	
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
				if(!mysql_select_db($dbname,$link)) {
					die("Select Database Failed: " . mysql_error($link));
				}
				 
				/*至此连接已完全建立，就可对当前数据库进行相应的操作了*/
				/*！！！注意，无法再通过本次连接调用mysql_select_db来切换到其它数据库了！！！*/
				/* 需要再连接其它数据库，请再使用mysql_connect+mysql_select_db启动另一个连接*/
				 
				/**
				 * 接下来就可以使用其它标准php mysql函数操作进行数据库操作
				 */
				 
				 $sql="SELECT `user` FROM `choujiang` WHERE `user`=  '" . iconv("UTF-8","GBK",$fromUsername) . "'";
				 $query=mysql_query($sql);
                 $rs=mysql_fetch_array($query);
                 $c= $rs['user'];
				 $c=iconv("GBK","UTF-8",$c);
				 		 
				 if ($c==$fromUsername)
				 {
				
				 $contentStr = "欢迎老朋友!";
				 }
				 else
				 {$sql="INSERT INTO `choujiang`(`id`,`user`) VALUES (NULL,'{$fromUsername}')";
				  mysql_query($sql);
				 $contentStr = "欢迎新朋友!";}
				 mysql_close($link);
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