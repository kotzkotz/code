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
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				
				if ($keyword=="秒杀")
				 {
				 $shijian=strtotime("2013-06-05 21:00:00")-time();
				  if($shijian>0)
				    {
					$contentStr = "对不起，秒杀还没开始，2013年6月5日21点开始";
				    }
				  else
				  {
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
						 $sql="SELECT `user` FROM `choujiang` WHERE `user`=  '" . iconv("UTF-8","GBK",$fromUsername) . "'";
						 $query=mysql_query($sql);
						 $rs=mysql_fetch_array($query);
						 $c= $rs['user'];
						 $c=iconv("GBK","UTF-8",$c);
								 
						 if ($c==$fromUsername)
						 {
						 $contentStr = "你已经秒杀过了!";
						 }
						 else
						 {
						 $sql="INSERT INTO `choujiang`(`id`,`user`) VALUES (NULL,'{$fromUsername}')";
						  mysql_query($sql);
				            $sql="SELECT `num` FROM `shuzi` WHERE 1";
							$query=mysql_query($sql);
							$rs=mysql_fetch_array($query);
							$b= $rs['num'];
							if ($b>0)
							 {
							 $contentStr = "恭喜你秒杀成功，凭此条微信到本店10元换取礼品";
							 $b--;
							 $sql="UPDATE `shuzi` SET `num`={$b} WHERE 1";
							 mysql_query($sql); 	
							 }
							else
							{
							$contentStr = "很遗憾，你没有秒杀成功，下次再来吧!";
							}
						}	
				 mysql_close($link);
			    }
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,  $contentStr);
               echo $resultStr;
			}
                }

        else {
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